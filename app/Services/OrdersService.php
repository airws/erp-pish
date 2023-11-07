<?php

namespace App\Services;

use App\Repositories\OrdersRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;

class OrdersService
{
    public static function getDetailOrder(int $orderId, $user)
    {
        $orderObject = app(OrdersRepository::class);
        $price = 0;
        /** @var OrdersRepository $orderObject*/
        $order = $orderObject->getOrderUser($user->id, $orderId);
        /** TODO добавить менеджеру получение аватарки и ссылку на чат*/
        $userObject = app(UserRepository::class);
        /** @var UserRepository $userObject*/
        $order->manager = $userObject->getUserInfo($order->manager_id);
        $order->payment = $orderObject->getPayerDetailsOrder($order->id);
        $order->bids = $orderObject->getBidsOrder($order->id);
        $programRepository = app(ProgramRepository::class);
        /** @var ProgramRepository $programRepository*/

        foreach ($order->bids as &$bid)
        {
            $bid->status = $orderObject->getStatusBidInfo($bid->status_id);
            $bid->programm = $programRepository->getProgram($bid->program_id);
            $bid->listeners = $orderObject->getListenerBid($bid->id);
            foreach ($bid->listeners as &$listener) {
                $listener->info = $userObject->getUserInfoInBid($listener->user_id);
                $listener->configs = $userObject->getConfigsListener($listener->id);
                $listener->configs->blocks = $programRepository->getBlocksFromGroup($listener->configs->group_programm_id);
                $price+=$listener->configs->price;
            }
            $bid->payment = $orderObject->getPaymentBid($bid->id);
        }
        $order->price = $price;
        if($loyalityProgram = $orderObject->getLoyalityProgram($order->price)){
            $order->loyalityProgram = $loyalityProgram;
            $order->priceDiscont = $order->price - ($order->price * ($loyalityProgram->percent/100));
        }
        return $order;
    }
}