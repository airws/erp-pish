<?php

namespace App\Exceptions;

use Exception;

class PayerNotFound extends Exception
{
    private const ERROR_CODE = 405;

    public function __construct(string $message = "Плательщик не найден")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
