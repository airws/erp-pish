<?php

namespace App\Services;

use App\Models\Orders\PayerDetail;
use App\Repositories\OrdersRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;
use App\DTO\PayerDetailDTO;
use App\Exceptions\PayerNotFound;

class OrdersService
{
    public static function getDetailOrder(int $orderId, $user)
    {
        $orderObject = app(OrdersRepository::class);
        $price = 0;
        /** @var OrdersRepository $orderObject */
        $order = $orderObject->getOrderUser($user->id, $orderId);
        /** TODO добавить менеджеру получение аватарки и ссылку на чат*/
        $userObject = app(UserRepository::class);
        /** @var UserRepository $userObject */
        $order->manager = $userObject->getUserInfo($order->manager_id);
        $order->payment = $orderObject->getPayerDetailsOrder($order->id);
        $order->bids = $orderObject->getBidsOrder($order->id);
        $programRepository = app(ProgramRepository::class);
        /** @var ProgramRepository $programRepository */

        foreach ($order->bids as &$bid) {
            $bid->status = $orderObject->getStatusBidInfo($bid->status_id);
            $bid->programm = $programRepository->getProgram($bid->program_id);
            $bid->listeners = $orderObject->getListenerBid($bid->id);
            foreach ($bid->listeners as &$listener) {
                $listener->info = $userObject->getUserInfoInBid($listener->user_id);
                $listener->configs = $userObject->getConfigsListener($listener->id);
                $listener->configs->blocks = $programRepository->getBlocksFromGroup($listener->configs->group_programm_id);
                $price += $listener->configs->price;
            }
            $bid->payment = $orderObject->getPaymentBid($bid->id);
        }
        $order->price = $price;
        if ($loyalityProgram = $orderObject->getLoyalityProgram($order->price)) {
            $order->loyalityProgram = $loyalityProgram;
            $order->priceDiscont = $order->price - ($order->price * ($loyalityProgram->percent / 100));
        }
        return $order;
    }

    public static function createPayerDetail(PayerDetailDTO $dto): PayerDetail
    {
        $payer = new PayerDetail();
        self::fillFieldsPayerDetail($dto, $payer);

        try {
            if (!$payer->save()) {
                throw new PayerDetailUpdateException("Не удалось сохранить данные плательщика.");
            }
        } catch (\Exception $e) {
            throw new PayerDetailUpdateException("Ошибка сохранения данных плательщика: " . $e->getMessage(), 0, $e);
        }

        return $payer;
    }

    public static function updatePayerDetail(PayerDetailDTO $dto, int $id): PayerDetail
    {
        $payer = PayerDetail::find($id);
        self::fillFieldsPayerDetail($dto, $payer);

        try {
            if (!$payer->save()) {
                throw new PayerDetailUpdateException("Не удалось сохранить данные плательщика.");
            }
        } catch (\Exception $e) {
            throw new PayerDetailUpdateException("Ошибка сохранения данных плательщика: " . $e->getMessage(), 0, $e);
        }

        return $payer;
    }

    public static function getPayer(int $orderId) : PayerDetail
    {
        $payer = PayerDetail::where('order_id', $orderId)->first();
        if(!$payer)
        {
            throw new PayerNotFound();
        }

        return $payer;
    }

    private static function fillFieldsPayerDetail(PayerDetailDTO $dto, PayerDetail $payer): PayerDetail
    {
        $payer->order_id = $dto->getOrderId();
        $payer->bik_bank = $dto->getBikBank();
        $payer->name_bank = $dto->getNameBank();
        $payer->rc = $dto->getRc();
        $payer->ks = $dto->getKs();
        $payer->kbk = $dto->getKbk();
        $payer->personal_account = $dto->getPersonalAccount();
        $payer->actual_address = $dto->getActualAddress();
        $payer->ur_address = $dto->getUrAddress();
        $payer->type_face = $dto->getTypeFace();
        $payer->inn = $dto->getInn();
        $payer->kpp = $dto->getKpp();
        $payer->ogrn = $dto->getOgrn();
        $payer->city = $dto->getCity();
        $payer->index = $dto->getIndex();
        $payer->abbreviation = $dto->getAbbreviation();
        $payer->full_ur_name = $dto->getFullUrName();
        $payer->fio_rod_head = $dto->getFioRodHead();
        $payer->fio_head = $dto->getFioHead();
        $payer->job_title = $dto->getJobTitle();
        $payer->acts_basis = $dto->getActsBasis();
        $payer->concluded_accordance = $dto->getConcludedAccordance();
        $payer->surname = $dto->getSurname();
        $payer->name = $dto->getName();
        $payer->patronymic = $dto->getPatronymic();
        $payer->snils = $dto->getSnils();
        $payer->registration_address = $dto->getRegistrationAddress();

        return $payer;
    }

}