<?php

namespace App\Listeners;

use App\Contracts\ISender;
use App\Events\RegisterUserEvent;
use App\Mail\RegisterUser;
use App\Services\Senders\MailSenderService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterUserListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterUserEvent $event): void
    {
        $user = $event->user;
        $password = $event->password;
        /** @var MailSenderService $mailer */
        $mailer = app(ISender::class);
        $mailer->send($user->email, new RegisterUser($password));
    }
}
