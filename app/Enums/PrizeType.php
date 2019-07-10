<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PrizeType extends Enum
{
    const MONEY = 0;
    const BONUS = 1;
    const ITEM = 2;
}
