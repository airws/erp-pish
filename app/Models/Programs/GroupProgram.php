<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupProgram extends Model
{
    use HasFactory;

    public function blocksProgram()
    {
        return $this->belongsToMany(BlocksProgram::class);
    }
}
