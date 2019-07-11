<?php

namespace App\Interfaces;

interface Prize
{
    /**
     * @return int
     */
    public function getKey(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int|null
     */
    public function getIdentifierValue(): ?int;

    /**
     * @return bool
     */
    public function hasIdentifier(): bool;

    /**
     * @return bool
     */
    public function hasAmount(): bool;

    /**
     * @return bool
     */
    public function canConvertedToMoney(): bool;

    /**
     * @return bool
     */
    public function canConvertedToBonus(): bool;

    /**
     * @return bool
     */
    public function isAvailable(): bool;
}
