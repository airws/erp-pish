<?php

namespace App\Repositories;

use App\Models\Files\File;

class FileRepository
{
    public static function getLastFile()
    {
        return File::select('id', 'name', 'path')->orderby('id', 'desc')->first();
    }
}