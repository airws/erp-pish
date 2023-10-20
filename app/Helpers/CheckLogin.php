<?php

namespace App\Helpers;

use Illuminate\Validation\Rule;

class CheckLogin
{
    public const TYPE_EMAIL = 'email';
    public const TYPE_SNILS = 'snils';


    public static function defineTypeLoginForAuth(string $login)
    {
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return self::TYPE_EMAIL;
        }
        return self::TYPE_SNILS;
    }
}