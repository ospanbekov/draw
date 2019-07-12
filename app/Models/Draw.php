<?php

namespace App\Models;

use App\Enums;
use App\Interfaces\Prize;
use App\Models\Abstracts\AbstractModel;
use Illuminate\Contracts\Support\Arrayable;

class Draw extends AbstractModel implements Arrayable
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
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
        /* create new draw with undefined status */
        return self::create([
            'status'  => Enums\DrawStatus::UNDEFINED,
            'type'    => $prize->getKey(),
            'amount'  => $prize->getAmount(),
            'item_id' => $prize->getIdentifierValue()
        ]);
    }

    /**
     * Convert model to array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'status'  => $this->status,
            'type' => $this->type,
            'amount'  => $this->amount,
            'item'    => $this->item
        ];
    }
}
