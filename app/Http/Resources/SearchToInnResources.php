<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchToInnResources extends JsonResource
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
                    'inn' => $daDataInfo['data']['inn'],
                    'ogrn' => $daDataInfo['data']['ogrn'],
                    'kpp' => $daDataInfo['data']['kpp'],
                    'index' => $daDataInfo['data']['address']['data']['postal_code'],
                    'abbreviation ' => $daDataInfo['data']['name']['short_with_opf'],
                    'full_ur_name ' => $daDataInfo['data']['name']['full_with_opf'],
                    'fio_rod_head ' => $daDataInfo['data']['management']['name'],
                    'ur_address' => $daDataInfo['data']['address']['value'],
                    'city' => $daDataInfo['data']['address']['data']['city'],
                ];
            }

        } else {
            $result = ['message' => 'По запросу не найдены результаты'];
        }

        return $result;
    }
}
