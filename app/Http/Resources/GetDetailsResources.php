<?php

namespace App\Http\Resources;

use App\Helpers\ChangeDateAndTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetDetailsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type_face' => $this->type_face,
            'order_id' => $this->order_id,
            'inn' => $this->inn,
            'kpp' => $this->kpp,
            'ogrn' => $this->ogrn,
            'city' => $this->city,
            'index' => $this->index,
            'abbreviation' => $this->abbreviation,
            'full_ur_name' => $this->full_ur_name,
            'fio_rod_head' => $this->fio_rod_head,
            'ur_address' => $this->ur_address,
            'actual_address' => $this->actual_address,
            'name_bank' => $this->name_bank,
            'rc' => $this->rc,
            'ks' => $this->ks,
            'bik_bank' => $this->bik_bank,
            'kbk' => $this->kbk,
            'personal_account' => $this->personal_account,
            'fio_head' => $this->fio_head,
            'job_title' => $this->job_title,
            'acts_basis' => $this->acts_basis,
            'concluded_accordance' => $this->concluded_accordance,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'snils' => $this->snils,
            'registration_address' => $this->registration_address,
        ];
    }
}
