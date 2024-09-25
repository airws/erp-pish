<?php

namespace App\Contracts;

/**
 * Интерфейс ISender.
 *
 * Предоставляет контракт для отправки сообщений.
 */
interface ISender
{
    /**
     * Отправляет сообщение.
     *
     * @param string $to Получатель сообщения.
     * @param mixed $message Само сообщение для отправки.
     * @return void
     */
    public function send(string $to, mixed $message);
}
