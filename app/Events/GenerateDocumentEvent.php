<?php

namespace App\Events;

use App\Models\Files\TemplatesDocument;
use App\Models\Files\TypesTemplate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GenerateDocumentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public TypesTemplate $type;
    public int $id;

    /**
     * Create a new event instance.
     */
    public function __construct(TypesTemplate $type, int $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

}
