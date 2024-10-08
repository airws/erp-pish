<?php

namespace App\Exceptions;

use Exception;

class AudienceNotFoundException extends Exception
{
    private const ERROR_CODE = 404;

    public function __construct(string $message = "Аудитория не найдена")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
