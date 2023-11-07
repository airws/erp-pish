<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public function typeEducationalPrograms()
    {
        return $this->belongsTo(TypeEducationalProgram::class, 'type_educational_program_id');
    }
}
