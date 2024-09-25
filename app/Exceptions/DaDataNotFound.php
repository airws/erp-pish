<?php

namespace App\Exceptions;

use Exception;

class DaDataNotFound extends Exception
{
    private const ERROR_CODE = 406;

    public function __construct(string $message = "Результатов нету")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
