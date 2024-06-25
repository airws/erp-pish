<?php

namespace App\Services;

use App\Exceptions\FileNotUploadException;
use App\Models\Files\File;
use App\Repositories\FileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FileFacade;

class FileService
{
    public static function saveFile(UploadedFile $file, string $path = 'upload', string $disk = 'public'): File
    {
        $fileStorage = Storage::disk($disk)->putFile($path, $file);
        if(!$fileStorage){
            throw new FileNotUploadException();
        }
        $fileInfo = self::saveInfoFileDB($fileStorage, $file->getClientOriginalName(), $disk, $file->getClientOriginalExtension());

        return $fileInfo;
    }

    public static function moveAndRmTemporaryFile($path, $name)
    {
        $newPath = Storage::disk('public')->path('doc').'/'.$name.'.docx';
        $moveResult = FileFacade::copy($path, $newPath);
        $delResult = Storage::delete($path);

        $fileInfo = self::saveInfoFileDB('storage/doc/'.$name.'.docx', $name.'docx', 'public', 'docx');

        return $fileInfo;
    }

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