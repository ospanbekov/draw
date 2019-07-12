<?php

namespace App\Models;

use App\Models\Abstracts\AbstractModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class AccessToken extends AbstractModel implements Arrayable
{
    protected $table = 'access_tokens';

    protected $fillable = [
        'user_id',
        'access_token',
        'created_at',
    ];

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
            'access_token' => Str::random(64),
            'created_at' => date('Y-m-d H:i:s', time())
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
     * Get User of current token
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
            'created_at' => $this->created_at
        ];
    }
}
