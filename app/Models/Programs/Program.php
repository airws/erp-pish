<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    public function typeEducationDocument()
    {
        return $this->belongsTo(TypesDocumentEducation::class, 'type_document_id');
    }

    public function formEducationProgram()
    {
        return $this->belongsTo(FormEducationProgramm::class, 'form_education_programm_id');
    }

    public function groupPrograms()
    {
        return $this->hasMany(GroupProgram::class, 'programm_id');
    }

    public function typeEducationalPrograms()
    {
        return $this->belongsTo(TypeEducationalProgram::class, 'type_educational_program_id');
    }
}
