<?php

namespace App\Http\Controllers\apiv1;

use App\DTO\ListenerDTO;
use App\Http\Requests\CreateListener;
use App\Http\Resources\CreateListenerResources;
use App\Http\Resources\DeleteListenerResources;
use App\Http\Resources\DeleteProgramInBidsResource;
use App\Services\BidService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProgramInBidsRequest;

class BidsController extends Controller
{
    public function deleteProgramInBids(DeleteProgramInBidsRequest $request)
    {
        $bid = BidService::deleteProgram($request->id, $request->bid_id);

        return new DeleteProgramInBidsResource($bid);
    }
    public function createListener(CreateListener $request)
    {
        $dto = new ListenerDTO($request->validated());
        $listener = BidService::createListener($dto);

        return new CreateListenerResources($listener);
    }
    public function deleteListener($listenerId)
    {
        return new DeleteListenerResources(BidService::deleteListener((int) $listenerId));
    }
}