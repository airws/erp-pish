<?php

namespace App\Services\Senders;

/**
 * Класс MailSenderService реализует интерфейс ISender
 * для управления отправкой электронной почты.
 *
 */
class MailSenderService implements \App\Contracts\ISender
{

    /**
     * Метод отправки сообщения на указанный адрес электронной почты.
     *
     * @param string $to Адрес электронной почты для отправки.
     * @param mixed  $message Сообщение для отправки.
     * @return void
     */
    public function send(string $to, mixed $message): void
    {
        \Mail::to($to)->send($message);
    }
}
