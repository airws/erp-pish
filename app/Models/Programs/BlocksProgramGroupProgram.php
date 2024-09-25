<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlocksProgramGroupProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blocks_program_group_program';
}
