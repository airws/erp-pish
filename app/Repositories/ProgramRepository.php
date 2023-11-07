<?php

namespace App\Repositories;

use App\Models\Programs\GroupProgram;
use App\Models\Programs\Program;

class ProgramRepository
{
    public function getProgram(int $programId)
    {
        return Program::select('id', 'name', 'price', 'type_document_id', 'count_clock', 'type_educational_program_id')
            ->where(['id' => $programId])
            ->where(['active' => 1])
            ->with('typeEducationalPrograms:id,name')
            ->first();
    }

    public function getBlocksFromGroup(int $idGroup)
    {
        $group = GroupProgram::select('id')-> where(['id'=>$idGroup])->with('blocksProgram:id,name')->first();
        foreach ($group->blocksProgram as &$block)
        {
            unset($block->pivot);
        }

        return $group->blocksProgram;
    }

}