<?php

namespace App\Services\Generators;

use App\Contracts\ISetDocumentData;
use Illuminate\Support\Facades\Storage;

class SetDocumentWithTemplate implements ISetDocumentData
{

    public function createDocumentWithTemplate(string $path, array $values): string
    {
        $template = new \PhpOffice\PhpWord\TemplateProcessor($path);
        foreach ($values as $key=>$value){
            $template->setValue($key, $value);
        }
        $temporaryPath = Storage::disk('local')->path('').'temporary_files/'.uniqid().'.docx';
        $template->saveAs($temporaryPath);
        return $temporaryPath;
    }
}