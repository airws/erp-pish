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
    public static function registerUser(
        string $name,
        string $email,
        string $surname,
        string $phone,
        string $snils,
        string $password,
        bool   $avalible_vo_spo,
        string $patronymic = '',
    ): User
    {
        //$password = self::generatedPassword();

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
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

    public static function updatePassword(User $user): bool
    {
        $password = self::generatedPassword();

        $result = $user->update(['password' => $password]);

        UpdateUserPasswordEvent::dispatch($user, $password);

        return $result;
    }

    private static function generatedPassword()
    {
        return Str::random(10);
    }

}