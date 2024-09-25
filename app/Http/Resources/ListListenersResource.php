<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListListenersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'listeners' => array_key_exists('listeners', $this->resource)?$this->resource['listeners']:[],
            'price' => array_key_exists('price', $this->resource)?$this->resource['price']:0,
        ];
    }
}
