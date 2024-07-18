<?php

namespace App\Http\Controllers\apiv1;

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
}