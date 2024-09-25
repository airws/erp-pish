<?php

namespace App\Repositories;

use App\Models\Programs\GroupProgram;
use App\Models\Programs\Program;

/**
 * Класс ProgramRepository.
 *
 * Репозиторий для работы с моделью Program.
 */
class ProgramRepository
{
    /**
     * Получает единственную модель Program по её id.
     *
     * @param  int  $programId id программы, которую нужно получить.
     * @return \App\Models\Programs\Program|null Возвращает модель Program или null, если модель не найдена.
     */
    public function searchProgram(string $q)
    {
        return Program::select('id', 'name', 'price', 'type_document_id', 'count_clock', 'type_educational_program_id','form_education_programm_id')
            ->where('name', 'like', '%' . $q . '%')
            ->where(['active' => 1])
            ->with(
                'typeEducationalPrograms:id,name,code',
                'typeEducationDocument:id,name,code',
                'groupPrograms:id,name,active,code,programm_id,type',
                'groupPrograms.blocksProgram:id,name,code,price',
                'formEducationProgram:id,name,code'
            )
            ->get();
    }

    /**
     * Получает единственную модель Program по её id.
     *
     * @param  int  $programId id программы, которую нужно получить.
     * @return \App\Models\Programs\Program|null Возвращает модель Program или null, если модель не найдена.
     */
    public function getProgram(int $programId)
    {
        return Program::select('id', 'name', 'price', 'type_document_id', 'count_clock', 'type_educational_program_id','form_education_programm_id')
            ->where(['id' => $programId])
            ->where(['active' => 1])
            ->with(
                'typeEducationalPrograms:id,name,code',
                'typeEducationDocument:id,name,code',
                'groupPrograms:id,name,active,code,programm_id,type',
                'groupPrograms.blocksProgram:id,name,code,price',
                'formEducationProgram:id,name,code'
            )
            ->first();
    }

    /**
     * Получает все блоки, связанные с определенной группой.
     *
     * @param  int  $idGroup id группы, из которой нужно получить блоки.
     * @return \Illuminate\Database\Eloquent\Collection Возвращает коллекцию блоков из группы.
     */
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
