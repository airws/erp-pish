<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

/**
 * Событие, которое срабатывает при регистрации пользователя.
 */
class RegisterUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Зарегистрированный пользователь.
     *
     * @var User
     */
    public User $user;

    /**
     * Пароль зарегистрированного пользователя.
     *
     * @var string
     */
    public string $password;

    /**
     * Создание нового экземпляра события.
     *
     * @param User $user Зарегистрированный пользователь.
     * @param string $password Пароль зарегистрированного пользователя.
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

}
