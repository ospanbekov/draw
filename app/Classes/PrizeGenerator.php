<?php

namespace App\Classes;

use App\Interfaces\Prize;

class PrizeGenerator
{
    /**
     * @var array
     */
    protected $prizeClasses = [];

    /**
     * PrizeGenerator constructor.
     *
     * @param array $prizeClasses
     */
    public function __construct(array $prizeClasses = [])
    {
        $this->prizeClasses = $prizeClasses;
    }

    /**
     * Get random item from $prizeClasses array.
     *
     * @return Prize $object
     */
    public function randomize()
    {
        /* get random key of array */
        $prizeIndexClass = array_rand($this->prizeClasses, 1);

        /* instance class */
        return new $this->prizeClasses[$prizeIndexClass];
    }
}
