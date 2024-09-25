<?php

namespace App\Listeners;

use App\Contracts\ISender;
use App\Events\AccessesByListenerEvent;
use App\Events\RegisterUserEvent;
use App\Mail\AccessesByListenerMail;
use App\Mail\RegisterUser;
use App\Services\Senders\MailSenderService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccessesByListenerListener implements ShouldQueue
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
    public function handle(AccessesByListenerEvent $event): void
    {
        $user = $event->user;
        $password = $event->password;
        $url = $event->url;
        /** @var MailSenderService $mailer */
        $mailer = app(ISender::class);
        $mailer->send($user->email, new AccessesByListenerMail($user->email, $password, $url));
    }
}
