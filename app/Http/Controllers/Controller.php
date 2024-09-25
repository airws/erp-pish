<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 *
 * Базовый контроллер приложения, предоставляющий возможности авторизации и валидации.
 * Все контроллеры в приложении должны наследоваться от этого класса.
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
