<?php

namespace App\Repositories;

use App\Models\Files\File;

/**
 * Репозиторий для работы с моделью файлов.
 *
 * Этот класс содержит методы для получения данных о файлах из базы данных.
 */
class FileRepository
{
    /**
     * Получить последний добавленный файл
     *
     * @return File Возвращает модель файла, который был добавлен последним.
     */
    public static function getLastFile()
    {
        return File::select('id', 'name', 'path')->orderby('id', 'desc')->first();
    }
}
