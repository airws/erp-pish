<?php

namespace App\Services\Generators;

use App\Contracts\IReceiverData;
use App\Helpers\ChangeDateAndTimeHelper;
use App\Repositories\OrdersRepository;
use App\Repositories\UserRepository;

class AgreementForServicesType implements IReceiverData
{

    public function getData(int $id): array
    {

        $orderRepository = app(OrdersRepository::class);
        /* @var OrdersRepository $orderRepository*/
        $payerInfo = $orderRepository->getPayerDetailsOrder($id);
        $bid = $orderRepository->getBidsOrder($id);
        $listenerId = $orderRepository->getListenerBid($bid[0]->id);
        $userRepository = app(UserRepository::class);
        /* @var UserRepository $userRepository*/
        $listener = $userRepository->getById($listenerId[0]->user_id);
        $listenerExtraOption = $userRepository->getExtraOptionListener($listenerId[0]->user_id);
        echo "<pre>";
        var_dump(ChangeDateAndTimeHelper::changeDateForDocument($listener->birthday));
        echo "</pre>";
        die();
        $result = [
            'id' => '',
            'full_ur_name' => $payerInfo->full_ur_name,
            'job_title' => $payerInfo->full_ur_name,
            'fio_rod_head' => $payerInfo->full_ur_name,
            'acts_basis' => $payerInfo->full_ur_name,
            'listener_fio' => $listener->surname.' '.$listener->name.' '.$listener->patronymic,
            'birthday' => ChangeDateAndTimeHelper::changeFormatDate($listener->birthday),


        ];
        dd($result);

        return [
            'id' => '1'
        ];
    }
}