<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchToBikResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [];
        if ($this->resource) {
            foreach ($this->resource as $daDataInfo) {
                $result[] = [
                    'bik_bank' => $daDataInfo['data']['bic'],
                    'name_bank' => $daDataInfo['value'],
                    'ks' => $daDataInfo['data']['correspondent_account'],
                ];
            }
        } else {
            $result = ['message' => 'По запросу не найдены результаты'];
        }

        return $result;
    }
}
