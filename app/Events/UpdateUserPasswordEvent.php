<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Событие, срабатывающее при обновлении пароля пользователя.
 */
class UpdateUserPasswordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Пользователь, обновляющий пароль.
     *
     * @var User
     */
    public User $user;

    /**
     * Новый пароль пользователя.
     *
     * @var string
     */
    public string $password;

    /**
     * Создание нового экземпляра события.
     *
     * @param User $user Пользователь, обновляющий пароль.
     * @param string $password Новый пароль пользователя.
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

}
