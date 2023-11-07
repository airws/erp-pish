<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Resources\FileUploadResource;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(FileRequest $request)
    {
        $file = FileService::saveFile($request->file('file'));

        return new FileUploadResource($file);
    }
}
