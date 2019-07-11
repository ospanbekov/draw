<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class Account extends Collection
{
    public function getAmount()
    {
        $total = 0;

        foreach ($this as $operation) {
            $total = $total + $operation->amount;
        }

        return $total;
    }
}
