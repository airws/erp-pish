<?php

namespace App\Contracts;

/**
 * Interface for setting document data.
 *
 * Интерфейс для установки данных документа.
 */
interface ISetDocumentData
{
    /**
     * Creates a document with a template.
     *
     * Создает документ с шаблоном.
     *
     * @param string $path The template path.
     *                          Путь к шаблону.
     *
     * @param array $values The data to insert into the template.
     *                          Данные для вставки в шаблон.
     *
     * @return string The created document.
     *                      Созданный документ.
     */
    public function createDocumentWithTemplate(string $path, array $values): string;
}
