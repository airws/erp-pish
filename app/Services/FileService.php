<?php

namespace App\Services;

use App\Exceptions\FileNotUploadException;
use App\Models\Files\File;
use App\Repositories\FileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FileFacade;

/**
 * Служба для работы с файлами.
 *
 * Этот класс содержит методы для сохранения, перемещения и удаления файлов.
 */
class FileService
{
    /**
     * Сохраняет файл на сервере и информацию о нем в базе данных.
     *
     * @param UploadedFile $file Файл, который следует загрузить.
     * @param string $path Путь, по которому файл должен быть загружен.
     * @param string $disk Диск, на котором файл будет храниться.
     *
     * @return File Возвращает модель файла с сохраненной информацией.
     *
     * @throws FileNotUploadException Если файл не удалось загрузить на сервер.
     */
    public static function saveFile(UploadedFile $file, string $path = 'upload', string $disk = 'public'): File
    {
        $fileStorage = Storage::disk($disk)->putFile($path, $file);
        if(!$fileStorage){
            throw new FileNotUploadException();
        }
        $fileInfo = self::saveInfoFileDB($fileStorage, $file->getClientOriginalName(), $disk, $file->getClientOriginalExtension());

        return $fileInfo;
    }

    /**
     * Перемещает файл из временного хранилища и удаляет его.
     * И сохраняет информацию о файле в базе данных
     *
     * @param $path Путь к временному файлу.
     * @param $name Имя файла.
     *
     * @return File Возвращает модель файла с сохраненной информацией.
     */
    public static function moveAndRmTemporaryFile($path, $name)
    {
        $newPath = Storage::disk('public')->path('doc').'/'.$name.'.docx';
        $moveResult = FileFacade::copy($path, $newPath);
        $delResult = Storage::delete($path);

        $fileInfo = self::saveInfoFileDB('storage/doc/'.$name.'.docx', $name.'docx', 'public', 'docx');

        return $fileInfo;
    }

    /**
     * Сохраняет информацию о файле в базе данных.
     *
     * @param string $filepath Путь к файлу на сервере.
     * @param string $fileName Имя файла.
     * @param string $disk Диск, на котором файл хранится.
     * @param string $type Тип файла.
     *
     * @return File Модель файла с сохраненной информацией.
     */
    private static function saveInfoFileDB(string $filepath, string $fileName, string $disk, string $type): File
    {
        $file = new File();

        $file->name = $fileName;
        $file->path = $filepath;
        $file->disk = $disk;
        $file->type = $type;
        $file->save();

        return $file;
    }
}
