<?php

namespace App\Exceptions;

use Illuminate\Validation\Validator;
use Exception;

class ValidatorException extends Exception
{
    /**
     * @var Validator|null
     */
    protected $validator = NULL;

    /**
     * ValidatorException constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return Validator|null
     */
    public function getValidator()
    {
        return $this->validator;
    }
}
