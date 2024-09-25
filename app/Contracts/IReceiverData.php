<?php

namespace App\Contracts;

/**
 * Интерфейс IReceiverData.
 *
 * Предоставляет контракт для получения данных.
 */
interface IReceiverData
{
    /**
     * Получает данные по указанному идентификатору.
     *
     * @param int $id Идентификатор для получения данных.
     * @return array Возвращает массив данных.
     */
    public function getData(int $id): array;
}
