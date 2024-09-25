<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetProgramByIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         $result = [
             'id' => $this->id,
             'name' => $this->name,
             'price' => $this->price,
             'count_clock' => $this->count_clock,
             'type_education_program' => $this->typeEducationalPrograms->name,
             'form_education_program' => $this->formEducationProgram->name,
             'type_document_education_program' => $this->typeEducationDocument->name,
             'groupProgram' => $this->groupPrograms,
         ];
         
        return $result;
    }
}
