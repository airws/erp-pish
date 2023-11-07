<?php

namespace App\Exceptions;

use Exception;

class FileNotUploadException extends Exception
{
    private const ERROR_CODE = 402;

    public function __construct(string $message = "Ошибка сервера, файл не был загружен")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}
