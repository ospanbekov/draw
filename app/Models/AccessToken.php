<?php

namespace App\Models;

use App\Models\Abstracts\AbstractModel;
use Illuminate\Contracts\Support\Arrayable;

class AccessToken extends AbstractModel implements Arrayable
{
    public $timestamps = false;
    protected $table = 'access_tokens';
    protected $fillable = ['user_id', 'access_token', 'revoked', 'created_at', 'expired_at'];

    /**
     * Create simple object
     *
     * @param  User $user
     * @param  String $expired MySQL format timestamp
     *
     * @return AccessToken model
     */
    public static function factory(User $user, $expired = NULL)
    {
        return self::create([
            'user_id' => $user->id,
            'access_token' => self::generateToken($user, $user->group),
            'refresh_token' => NULL,
            'revoked' => 0,
            'created_at' => date('Y-m-d H:i:s', time()),
            'expired_at' => $expired
        ]);
    }

    /**
     * Check token
     *
     * @param  String $token
     * @return AccessToken
     */
    public static function checkToken($token, array $credentials = [])
    {
        if ($data = self::extractToken($token)) {
            return self::where(array_merge($credentials, [
                'user_id' => $data['user_id'],
                'guard_type' => $data['guard']
            ]))->first();
        }
        return NULL;
    }

    /**
     * Verify token
     *
     * @return boolean
     */
    public static function verifyToken($token)
    {
        $arr = explode('.', base64_decode($token));
        if (!is_array($arr) || sizeof($arr) < 4) {
            return false;
        }
        if (md5($arr[0] . $arr[1] . env('APP_KEY')) !== $arr[2]) {
            return false;
        }
        return true;
    }

    /**
     * Extract data from token string
     *
     * @return array
     */
    public static function extractToken($token)
    {
        if (!self::verifyToken($token)) {
            return false;
        }
        /* */
        $data = explode('.', base64_decode($token));
        return [
            'user_id' => $data[0],
            'guard' => $data[1],
            'signature' => $data[2],
            'random' => $data[3]
        ];
    }

    /**
     * Generate new token
     *
     * @return String
     */
    protected static function generateToken(User $user, $guard)
    {
        return base64_encode(
            implode('.', [
                $user->id, $guard, md5($user->id . $guard . env('APP_KEY')), uniqid()
            ])
        );
    }

    /**
     * Revoke token
     *
     * @return void
     */
    public function revokeToken()
    {
        $this->revoked = true;
    }

    /**
     * Get User of current token
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check is token revoked
     *
     * @return boolean
     */
    public function isRevoked()
    {
        return (bool)$this->revoked;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => (int)$this->id,
            'user_id' => (int)$this->user_id,
            'access_token' => $this->access_token,
            'revoked' => $this->isRevoked(),
            'created_at' => $this->created_at,
            'expired_at' => $this->expired_at
        ];
    }
}
