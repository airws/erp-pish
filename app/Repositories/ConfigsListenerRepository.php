<?php

namespace App\Repositories;

use App\Models\Orders\Bids\ConfigsListener;

class ConfigsListenerRepository
{
    public function getConfigsByListenerId(int $listenerId): \Illuminate\Database\Eloquent\Collection
    {
        return ConfigsListener::where('listener_id', $listenerId)->get();
    }
}