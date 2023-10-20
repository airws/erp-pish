<?php
namespace App\Services\Senders;

class MailSenderService implements \App\Contracts\ISender
{

    public function send(string $to, mixed $message): void
    {
        \Mail::to($to)->send($message);
    }
}