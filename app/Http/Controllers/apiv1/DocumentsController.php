<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{

    public function createDocumentsTemplate(Request $request)
    {
        $phpWord = new  \PhpOffice\PhpWord\PhpWord();
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('storage/template_doc/doc.docx'));
        $template->setValue('id', 1);
        $template->saveAs(storage_path('app/public/doc/doc1.docx'));
        dd($template);
    }
}
