<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ProgramInBidNotFound extends Exception
{
    private const ERROR_CODE = 403;

    public function __construct(string $message = "Программа в заявке не найдена")
    {
        parent::__construct($message, self::ERROR_CODE);
    }
}