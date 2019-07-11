<?php

namespace App\Classes;

use App\Enums\PrizeType;
use App\Interfaces\Prize;

class Item implements Prize
{
    /**
     * @var null
     */
    protected $item = null;

    /**
     * Item constructor.
     */
    public function __construct()
    {
        $this->item = \App\Models\Item::inRandomOrder()->where('quantity', '>', '0')->first();
    }

    /**
     * @return int
     */
    public function getKey(): int
    {
        return PrizeType::ITEM;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return PrizeType::getDescription($this->getKey());
    }

    /**
     * @return int|null
     */
    public function getIdentifierValue(): ?int
    {
        return $this->item->id;
    }

    /**
     * @return bool
     */
    public function hasIdentifier(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function hasAmount(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function canConvertedToMoney(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function canConvertedToBonus(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return !empty($this->item);
    }
}
