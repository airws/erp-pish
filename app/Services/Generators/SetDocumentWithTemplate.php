<?php

namespace App\Services\Generators;

use App\Contracts\ISetDocumentData;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\IOFactory;

/**
 * Class SetDocumentWithTemplate
 *
 * Этот класс реализует интерфейс ISetDocumentData и используется для создания документов на основе шаблона,
 * а также их последующей конвертации в PDF.
 *
 * @package App\Services\Generators
 */
class SetDocumentWithTemplate implements ISetDocumentData
{
    /**
     * Создает документ на основе шаблона и возвращает путь к созданному файлу.
     *
     * @param string $path Путь к шаблону документа (.docx).
     * @param array $values Ассоциативный массив значений для замены в шаблоне.
     * @return string Возвращает путь к созданному временному файлу (.docx).
     */
    public function createDocumentWithTemplate(string $path, array $values): string
    {
        $template = new \PhpOffice\PhpWord\TemplateProcessor($path);
        foreach ($values as $key => $value) {
            $template->setValue($key, $value);
        }

        // Создание временного пути для сохранения документа
        $temporaryPath = Storage::disk('local')->path('temporary_files') . '/' . uniqid() . '.docx';
        $template->saveAs($temporaryPath);

        return $temporaryPath;
    }

    /**
     * Конвертирует документ в формате .docx в PDF и сохраняет его.
     *
     * @param string $filePath Путь к исходному файлу .docx.
     * @param string $name Имя для сохраненного PDF файла.
     * @return void
     */
    public function convertToPdf(string $filePath, string $name): void
    {
        // Настройка рендерера PDF
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('/var/www/vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF);
        \PhpOffice\PhpWord\Settings::setPdfRenderer('DomPDF', '/var/www/vendor/dompdf/dompdf');

        // Загрузка документа .docx
        $phpWord = IOFactory::load($filePath);
        $phpWord->setDefaultFontName('arial');

        // Конвертация в PDF и сохранение
        $xmlWriter = IOFactory::createWriter($phpWord, 'PDF');
        $xmlWriter->save(Storage::disk('public')->path('doc') . '/' . $name . '.pdf');
    }
}
