<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    private const ERROR_CODE = 401;

    public function __construct(string $message = "Пользователь не найден")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
