<?php

namespace App\Listeners;

use App\Contracts\ISender;
use App\Events\UpdateUserPasswordEvent;
use App\Mail\ForgotPasswordMail;
use App\Services\Senders\MailSenderService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserPasswordListener implements ShouldQueue
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
    public function handle(UpdateUserPasswordEvent $event): void
    {
        $user = $event->user;
        $password = $event->password;
        /** @var MailSenderService $mailer */
        $mailer = app(ISender::class);
        $mailer->send($user->email, new ForgotPasswordMail($password));
    }
}
