<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    public function typeEducationalPrograms()
    {
        return $this->belongsTo(TypeEducationalProgram::class, 'type_educational_program_id');
    }
}
