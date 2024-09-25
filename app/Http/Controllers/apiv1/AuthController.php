<?php

namespace App\Http\Controllers\apiv1;

use App\Exceptions\AuthException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\RegisterResources;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterUser;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequestRequest;
use App\Http\Requests\AuthRequest;

/**
 * Class AuthController
 *
 * Контроллер для управления процессом аутентификации и регистрации пользователей.
 *
 * @package App\Http\Controllers\apiv1
 */
class AuthController extends Controller
{
    /**
     * Регистрирует нового пользователя.
     *
     * @param RegisterRequestRequest $request
     * @return RegisterResources
     */
    public function createUser(RegisterRequestRequest $request)
    {
        $validateUserData = $request->validated();

        $user = UserService::registerUser(
            $validateUserData['name'],
            $validateUserData['email'],
            $validateUserData['surname'],
            $validateUserData['phone'],
            $validateUserData['snils'],
            //$validateUserData['password'],
            (bool) $validateUserData['avalible_vo_spo'],
            $validateUserData['patronymic'],
        );

        return new RegisterResources([
            'message' => 'Пользователь зарегистрирован',
            'token' => $user->createTokenUser()
        ]);
    }

    /**
     * Авторизует пользователя.
     *
     * @param AuthRequest $request
     * @return AuthResource
     * @throws AuthException
     */
    public function loginUser(AuthRequest $request)
    {
        $validateUserData = $request->validated();

        if (!$user = UserService::authUser($validateUserData['login'], $validateUserData['password'])) {
            throw new AuthException();
        }

        return new AuthResource([
            'message' => 'Пользователь авторизован',
            'token' => $user->createTokenUser()
        ]);
    }

    /**
     * Процесс сброса пароля пользователя.
     *
     * @param ForgotPasswordRequest $request
     * @return AuthResource
     * @throws UserNotFoundException
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $validateUserData = $request->validated();
        $userReposity = new UserRepository();

        if (!$user = $userReposity->getByEmail($validateUserData['email'])) {
            throw new UserNotFoundException();
        }

        UserService::updatePassword($user);

        // \Mail::to($validateUserData['email'])->send(new ForgotPasswordMail($password));

        return new AuthResource([
            'message' => 'Пароль отправлен на указанную вами почту',
        ]);
    }
}
