<?php

namespace App\Http\Resources;

use App\Helpers\ChangeDateAndTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteProgramInBidsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $deleted_at = ChangeDateAndTimeHelper::changeFormatDateAndTime($this->deleted_at);

        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'program_id' => $this->program_id,
            'deleted_at' => $deleted_at,
        ];
    }
}
