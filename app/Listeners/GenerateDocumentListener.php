<?php

namespace App\Listeners;

use App\Contracts\IReceiverData;
use App\Contracts\ISender;
use App\Contracts\ISetDocumentData;
use App\Events\GenerateDocumentEvent;
use App\Factories\ReceiverDataFactory;
use App\Models\Files\File;
use App\Models\Files\TemplatesDocument;
use App\Services\FileService;
use App\Services\Generators\SetDocumentWithTemplate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class GenerateDocumentListener
{
    private IReceiverData $receiverData;

    /**
     * Create the event listener.
     */
    public function __construct()
    {


    }

    /**
     * Handle the event.
     */
    public function handle(GenerateDocumentEvent $event): void
    {
        $this->receiverData = ReceiverDataFactory::create($event->type);
        list($name, $insertData) = $this->receiverData->getData($event->id);
        $templateDoc = TemplatesDocument::select('id', 'file_id')->where(['type_id' => $event->type->id])->first();
        $file = File::select('id', 'path', 'disk')->where(['id' => $templateDoc->file_id])->first();
        /** @var SetDocumentWithTemplate $generate */
        $generate = app(ISetDocumentData::class);
        $timePath = $generate->createDocumentWithTemplate(Storage::disk($file->disk)->path($file->path), $insertData);

        $newPath = FileService::moveAndRmTemporaryFile($timePath, $name);

    }
}
