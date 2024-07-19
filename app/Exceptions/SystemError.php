<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class SystemError extends Exception
{
    private const ERROR_CODE = 404;

    public function __construct(string $message = "Системная ошибка")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
