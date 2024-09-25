<?php

namespace App\Http\Controllers\apiv1;

use App\DTO\ListenerDTO;
use App\Http\Requests\CreateBidRequest;
use App\Http\Requests\CreateListenerRequest;
use App\Http\Requests\GetListenerByIdRequest;
use App\Http\Requests\GetProgramByIdRequest;
use App\Http\Requests\JoinListenerInBidRequest;
use App\Http\Requests\ListListenerRequest;
use App\Http\Requests\RegisterRequestRequest;
use App\Http\Requests\SearchProgramRequest;
use App\Http\Requests\UpdateListenerRequest;
use App\Http\Resources\CreateBidResource;
use App\Http\Resources\CreateListenerResources;
use App\Http\Resources\DeleteListenerResources;
use App\Http\Resources\DeleteProgramInBidsResource;
use App\Http\Resources\GetListenerByIdResource;
use App\Http\Resources\GetProgramByIdResource;
use App\Http\Resources\JoinListenerInBidResource;
use App\Http\Resources\ListListenersResource;
use App\Http\Resources\SearchProgramResource;
use App\Http\Resources\UpdateListenerResources;
use App\Services\BidService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProgramInBidsRequest;

/**
 * Class BidsController
 *
 * Контроллер для управления заявками и слушателями программ.
 *
 * @package App\Http\Controllers\apiv1
 */
class BidsController extends Controller
{
    public function joinListenerInBid(JoinListenerInBidRequest $request)
    {
        $listenerIds = BidService::joinListenerInBid((array) $request->listener_ids, (int) $request->bid_id);

        return new JoinListenerInBidResource($listenerIds);
    }
    public function getProgramById(GetProgramByIdRequest $request)
    {
        $program = BidService::getProgramById($request->program_id);

        return new GetProgramByIdResource($program);
    }
    public function getListenerById(GetListenerByIdRequest $request)
    {
        $listener = BidService::getListenerById($request->listener_id);

        return new GetListenerByIdResource($listener);
    }
    public function updateListener(UpdateListenerRequest $request)
    {
        $dto = new ListenerDTO($request->validated());
        $listener = BidService::updateListener($dto);

        return new UpdateListenerResources($listener);
    }
    public function searchProgram(SearchProgramRequest $request)
    {
        $programs = BidService::searchProgram($request->q);

        return new SearchProgramResource($programs);
    }

    public function createBid(CreateBidRequest $request)
    {
        $bid = BidService::createBid(
            (int) $request->order_id,
            (int) $request->program_id,
            (array) $request->user_id,
            (array) $request->group_program_id,
            (array) $request->surname,
            (array) $request->name,
            (array) $request->patronymic,
            (array) $request->phone,
            (array) $request->email,
            (array) $request->snils,
            (array) $request->avalible_vo_spo,
        );

        return new CreateBidResource($bid);
    }


    /**
     * Удаляет программу из заявки.
     *
     * @param DeleteProgramInBidsRequest $request
     * @return DeleteProgramInBidsResource
     */
    public function deleteProgramInBids(DeleteProgramInBidsRequest $request)
    {
        $bid = BidService::deleteProgram($request->id, $request->bid_id);

        return new DeleteProgramInBidsResource($bid);
    }

    /**
     * Спиоск слушателей в заявке.
     *
     * @param ListListenerRequest $request
     * @return CreateListenerResources
     */
    public function listListeners(ListListenerRequest $request)
    {
        $listener = BidService::listListers($request->order_id);

        return new ListListenersResource($listener);
    }

    /**
     * Список слушателей в заявке.
     *
     * @param CreateListenerRequest $request
     * @return CreateListenerResources
     */
    public function createListener(CreateListenerRequest $request)
    {
        $dto = new ListenerDTO($request->validated());
        $listener = BidService::createListener($dto);

        return new CreateListenerResources($listener);
    }


    /**
     * Удаляет слушателя из заявки.
     *
     * @param int $listenerId
     * @return DeleteListenerResources
     */
    public function deleteListener($listenerId)
    {
        return new DeleteListenerResources(BidService::deleteListener((int) $listenerId));
    }
}
