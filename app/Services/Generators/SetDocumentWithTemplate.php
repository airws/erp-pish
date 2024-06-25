<?php

namespace App\Services\Generators;

use App\Contracts\ISetDocumentData;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\IOFactory;

class SetDocumentWithTemplate implements ISetDocumentData
{

    public function createDocumentWithTemplate(string $path, array $values): string
    {
        $template = new \PhpOffice\PhpWord\TemplateProcessor($path);
        foreach ($values as $key=>$value){
            $template->setValue($key, $value);
        }
        $temporaryPath = Storage::disk('local')->path('temporary_files').'/'.uniqid().'.docx';
        $template->saveAs($temporaryPath);
        //$path = $this->convertToPdf($temporaryPath);
        return $temporaryPath;
    }

    public function convertToPdf($filePath, $name)
    {
        \PhpOffice\PhpWord\Settings::setPdfRendererPath( '/var/www/vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF);
        \PhpOffice\PhpWord\Settings::setPdfRenderer('DomPDF', '/var/www/vendor/dompdf/dompdf');

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
        //$phpWord->setDefaultFontName('timesnrcyrmt');
        $phpWord->setDefaultFontName('arial');

        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
        $xmlWriter->save(Storage::disk('public')->path('doc').'/'.$name.'.pdf');
    }
}