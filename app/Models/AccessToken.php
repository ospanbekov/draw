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
        return self::where(array_merge($credentials, [
            'access_token' => $token
        ]))->first();
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
