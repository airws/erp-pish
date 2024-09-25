<?php

namespace App\Http\Resources;

use App\Helpers\ChangeDateAndTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateBidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bid_id' => $this->resource,
        ];
    }
}
