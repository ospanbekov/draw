<?php

namespace App\Models;

use App\Interfaces\Prize;
use App\Models\Abstracts\AbstractModel;

class Draw extends AbstractModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item_id', 'type', 'amount'
    ];

    /**
     * Get the user that owns the draw.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item record associated with the draw.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function item()
    {
        return $this->hasOne(Item::class);
    }

    /**
     * Draw factory.
     *
     * @param User $user
     * @param Prize $prize
     * @return Draw
     */
    public static function factory(User $user, Prize $prize)
    {
        return new self([
            'user_id' => $user->id,
            'type' => $prize->getName()
        ]);
    }
}
