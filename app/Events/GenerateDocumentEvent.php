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

/**
 * Событие, которое срабатывает, когда необходимо сгенерировать документ.
 */
class GenerateDocumentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Тип шаблона.
     *
     * @var TypesTemplate
     */
    public TypesTemplate $type;

    /**
     * Идентификатор документа для генерации.
     *
     * @var int
     */
    public int $id;

    /**
     * Создать новый экземпляр события.
     *
     * @param TypesTemplate $type Тип шаблона.
     * @param int $id Идентификатор документа для генерации.
     */
    public function __construct(TypesTemplate $type, int $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

}
