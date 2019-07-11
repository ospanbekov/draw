<?php

namespace App\Classes;

use App\Enums\PrizeType;
use App\Interfaces\Prize;

class Bonus implements Prize
{
    /**
     * @var int
     */
    protected $bonus = 0;

    /**
     * Bonus constructor.
     */
    public function __construct()
    {
        $this->bonus = rand(0, 1000);
    }

    /**
     * @return int
     */
    public function getKey(): int
    {
        return PrizeType::BONUS;
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
        return null;
    }

    /**
     * @return bool
     */
    public function hasIdentifier(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasAmount(): bool
    {
        return true;
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
        return true;
    }
}
