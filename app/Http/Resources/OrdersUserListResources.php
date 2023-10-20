<?php

namespace App\Http\Resources;

use App\Helpers\ChangeDateAndTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersUserListResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = 'Заявка №'.$this->id;
        $created_at = ChangeDateAndTimeHelper::changeFormatDateAndTime($this->created_at);

        return [
            'id' => $this->id,
            'name' => $name,
            'created_at' => $created_at
        ];
    }
}
