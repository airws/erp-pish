<?php

namespace App\Services;

use App\Exceptions\FileNotUploadException;
use App\Models\Files\File;
use App\Repositories\FileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    public static function moveAndRmTemporaryFile($path)
    {
        $moveResult = Storage::move($path, Storage::disk('public')->path('doc').'/test44.docx');
        $delResult = Storage::delete($path);
        return true;
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