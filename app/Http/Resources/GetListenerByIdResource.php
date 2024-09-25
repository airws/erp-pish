<?php

namespace App\Http\Resources;

use App\Helpers\ChangeDateAndTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetListenerByIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this['user'],
            'config_listener' => $this['config_listener'],
        ];
    }
}
