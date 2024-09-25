<?php

namespace App\Helpers;

use Illuminate\Validation\Rule;

/**
 * Класс CheckLogin.
 *
 * Помощник для работы с логинами пользователей.
 */
class CheckLogin
{
    /**
     * Константа, обозначающая тип логина - email.
     */
    public const TYPE_EMAIL = 'email';

    /**
     * Константа, обозначающая тип логина - СНИЛС.
     */
    public const TYPE_SNILS = 'snils';

    /**
     * Определяет тип логина для аутентификации.
     *
     * Проверяет, является ли логин адресом электронной почты.
     * Если это так, возвращается тип TYPE_EMAIL, иначе - TYPE_SNILS.
     *
     * @param string $login Логин, который следует проверить.
     * @return string Возвращает тип логина.
     */
    public static function defineTypeLoginForAuth(string $login)
    {
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return self::TYPE_EMAIL;
        }
        return self::TYPE_SNILS;
    }
}
