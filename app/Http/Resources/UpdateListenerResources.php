<?php

namespace App\Http\Resources;

use App\Helpers\ChangeDateAndTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateListenerResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'listener_id' => $this['listener_id'],
            'user' => $this['user'],
            'config_listener' => $this['config_listener'],
        ];
    }
}
