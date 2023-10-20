<?php

namespace App\Repositories;

use App\Models\Programs\Programs;

class ProgramRepository
{
    public function getProgram(int $programId)
    {
        return Programs::select('id', 'name', 'price', 'type_document_id', 'count_clock')->where(['id' => $programId])->where(['active' => 1])->first();
    }
}