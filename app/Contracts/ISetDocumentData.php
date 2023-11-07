<?php

namespace App\Contracts;

interface ISetDocumentData
{
    public function createDocumentWithTemplate(string $path, array $values): string;
}