<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AuthException extends Exception
{
    private const ERROR_CODE = 401;

    public function __construct(string $message = "Не правильно введен пароль или логин.")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
