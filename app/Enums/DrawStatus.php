<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DrawStatus extends Enum
{
    const REJECTED = 0;
    const ACCEPTED = 1;
    const EXCHANGED = 2;
    const UNDEFINED = 9;
}
