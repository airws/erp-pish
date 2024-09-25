<?php

namespace App\Exceptions;

use Exception;

class OrderNotFoundException extends Exception
{
    private const ERROR_CODE = 407;

    public function __construct(string $message = "Заказ у пользователя не найден")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
