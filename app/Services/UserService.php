<?php

namespace App\Services;

use App\Events\RegisterUserEvent;
use App\Events\UpdateUserPasswordEvent;
use App\Helpers\CheckLogin;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function updateUser(
        User $user,
        string $name,
        string $email,
        string $surname,
        string $phone,
        string $snils,
        bool   $avalible_vo_spo,
        string $patronymic = '',
    ): ?User
    {

        $userData = [
            'name' => $name,
            'email' => $email,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'phone' => $phone,
            'snils' => $snils,
            'avalible_vo_spo' => $avalible_vo_spo,
        ];
        $update = $user->update($userData);

        return $user;
    }

    /**
     * Регистрирует нового пользователя.
     *
     * @param string $name Имя пользователя.
     * @param string $email Адрес электронной почты пользователя.
     * @param string $surname Фамилия пользователя.
     * @param string $phone Номер телефона пользователя.
     * @param string $snils СНИЛС пользователя.
     * @param bool $avalible_vo_spo Доступ к ВО СПО.
     * @param string $patronymic Отчество пользователя (необязательно).
     * @return User Созданный пользователь.
     */
    public static function registerUser(
        string $name,
        string $email,
        string $surname,
        string $phone,
        string $snils,
        bool   $avalible_vo_spo,
        string $patronymic = '',
    ): User
    {
        $password = self::generatedPassword();

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'phone' => $phone,
            'snils' => $snils,
            'avalible_vo_spo' => $avalible_vo_spo,
        ];
        $user = User::create($userData);

        RegisterUserEvent::dispatch($user, $password);

        return $user;
    }

    /**
     * Аутентифицирует пользователя по логину и паролю.
     *
     * @param string $login Логин пользователя (email или SNILS).
     * @param string $password Пароль пользователя.
     * @return User|null Возвращает пользователя, если аутентификация успешна, иначе null.
     */
    public static function authUser(string $login, string $password): ?User
    {
        $typeLogin = CheckLogin::defineTypeLoginForAuth($login);

        if($typeLogin == CheckLogin::TYPE_EMAIL) {
            if (!Auth::attempt(['email' => $login, 'password' => $password])) {
                return null;
            }

        } elseif($typeLogin == CheckLogin::TYPE_SNILS) {

            if (!Auth::attempt(['snils' => $login, 'password' => $password])) {
                return null;
            }

        } else {
            /*TODO сделать exception*/
        }

        return auth()->user();
    }

    /**
     * Обновляет пароль пользователя и уведомляет об этом событие.
     *
     * @param User $user Пользователь, для которого необходимо обновить пароль.
     * @return bool Возвращает true, если обновление прошло успешно, иначе false.
     */
    public static function updatePassword(User $user): bool
    {
        $password = self::generatedPassword();

        $result = $user->update(['password' => $password]);

        UpdateUserPasswordEvent::dispatch($user, $password);

        return $result;
    }

    /**
     * Генерирует случайный пароль длиной 10 символов.
     *
     * @return string Случайный пароль.
     */
    private static function generatedPassword()
    {
        return Str::random(10);
    }

}