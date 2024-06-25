<?php

namespace App\Services\Generators;

use App\Contracts\IReceiverData;
use App\Helpers\ChangeDateAndTimeHelper;
use App\Repositories\OrdersRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;

class AgreementForServicesType implements IReceiverData
{

    public function getData(int $id): array
    {

        $orderRepository = app(OrdersRepository::class);
        /* @var OrdersRepository $orderRepository*/
        $payerInfo = $orderRepository->getPayerDetailsOrder($id);
        $order = $orderRepository->getOrderById($id);
        $bid = $orderRepository->getBidsOrder($id);
        $listenerId = $orderRepository->getListenerBid($bid[0]->id);
        $userRepository = app(UserRepository::class);
        /* @var UserRepository $userRepository*/
        $listener = $userRepository->getById($listenerId[0]->user_id);
        $listenerExtraOption = $userRepository->getExtraOptionListener($listenerId[0]->user_id);
        $programRepository = app(ProgramRepository::class);
        /* @var ProgramRepository $programRepository */
        $program = $programRepository->getProgram($bid[0]->program_id);
        $client = $userRepository->getById($order->user_id);

        list($day, $month, $year) = ChangeDateAndTimeHelper::changeDateForDocument($order->created_at);
        list($passportDay, $passportMonth, $passportYear) = ChangeDateAndTimeHelper::changeDateForDocument($listenerExtraOption->date_of_issue);

        $result = [
            'id' => $order->id,
            'full_ur_name' => $payerInfo->full_ur_name,
            'job_title' => $payerInfo->job_title,
            'fio_rod_head' => $payerInfo->fio_rod_head,
            'acts_basis' => $payerInfo->acts_basis,
            'listener_fio' => $listener->surname.' '.$listener->name.' '.$listener->patronymic,
            'birthday' => ChangeDateAndTimeHelper::changeFormatDate($listener->birthday),
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'inn' => $payerInfo->inn,
            'kpp' => $payerInfo->kpp,
            'bik_bank' => $payerInfo->bik_bank,
            'rc' => $payerInfo->rc,
            'ks' => $payerInfo->ks,
            'ur_address' => $payerInfo->ur_address,
            'listener_passport' => $listenerExtraOption->series_and_passport_number,
            'listener_day_issuance_passport' => $passportDay,
            'listener_month_issuance_passport' => $passportMonth,
            'listener_year_issuance_passport' => $passportYear,
            'listener_issued_by_passport' => $listenerExtraOption->issued_by,
            'bank' => $payerInfo->name_bank,
            'residence_address' => $listenerExtraOption->residence_address,
            'listener_snils' => $listener->snils,
            'listener_phone' => $listener->phone,
            'client_phone' => $client->phone,
            'program_name' => $program->name,
            'program_clock' => $program->price,
            'program_price' => $program->clock,
            'listener_initials' => $listener->surname.' '.mb_substr($listener->name, 0).'.'.mb_substr($listener->patronymic,0),
            'customer_initials' => $client->surname.' '.mb_substr($client->name, 0).'.'.mb_substr($client->patronymic,0)


        ];

        return ['Договор_'.ChangeDateAndTimeHelper::changeFormatDateForNameFile($order->created_at).'_'.$client->surname.'_'.$bid[0]->id, $result];
    }
}