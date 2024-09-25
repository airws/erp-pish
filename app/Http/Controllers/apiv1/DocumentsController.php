<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

/**
 * Class DocumentsController
 *
 * Контроллер для работы с шаблонами документов.
 *
 * @package App\Http\Controllers\apiv1
 */
class DocumentsController extends Controller
{
    /**
     * Создает документ на основе шаблона и сохраняет его.
     *
     * Этот метод загружает шаблон документа, заменяет в нем значения переменных
     * и сохраняет результат в директории `storage/app/public/doc/`.
     *
     * @param Request $request
     * @return void
     */
    public function createDocumentsTemplate(Request $request)
    {
        $phpWord = new PhpWord();
        $template = new TemplateProcessor(public_path('storage/template_doc/doc.docx'));

        // Замена значений в шаблоне
        $template->setValue('id', 1);

        // Сохранение документа
        $template->saveAs(storage_path('app/public/doc/doc1.docx'));

        // Вывод шаблона для отладки
        dd($template);
    }
}
