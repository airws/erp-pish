<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [];

        foreach ($this->resource as $program)
        {
            $result[] = [
                'id' => $program->id,
                'name' => $program->name,
                'price' => $program->price,
                'count_clock' => $program->count_clock,
                'type_education_program' => $program->typeEducationalPrograms->name,
                'form_education_program' => $program->formEducationProgram->name,
                'type_document_education_program' => $program->typeEducationDocument->name,
                'groupProgram' => $program->groupPrograms,
            ];
        }

        return $result;
    }
}
