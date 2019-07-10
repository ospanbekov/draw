<?php

namespace App\Models\User\Account;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount'
    ];

    /**
     * Get the user that owns the bonus account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
