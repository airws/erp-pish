<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Resources\FileUploadResource;
use App\Services\FileService;
use Illuminate\Http\Request;

/**
 * Class FileController
 *
 * Контроллер для работы с файлами.
 *
 * @package App\Http\Controllers\apiv1
 */
class FileController extends Controller
{
    /**
     * Загружает файл и сохраняет его с использованием FileService.
     *
     * @param FileRequest $request
     * @return FileUploadResource
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function upload(FileRequest $request)
    {
        $file = FileService::saveFile($request->file('file'));

        return new FileUploadResource($file);
    }
}
