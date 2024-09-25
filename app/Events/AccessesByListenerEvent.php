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
class AccessesByListenerEvent
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
    public string $url;


    public function __construct(User $user, string $password,string $url)
    {
        $this->user = $user;
        $this->password = $password;
        $this->url = $url;
    }

}
