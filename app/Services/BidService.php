<?php

namespace App\Services;

use App\DTO\ListenerDTO;
use App\Exceptions\ProgramInBidNotFound;
use App\Exceptions\SystemError;
use App\Models\Orders\Bids\Bid;
use App\Models\Orders\Bids\ConfigsListener;
use App\Models\Orders\Bids\UserBid;

class BidService
{
    public static function deleteProgram(string $id, string $bidId) : Bid
    {
        $bid = Bid::where(['id' => $bidId, 'program_id' => $id])->first();
        if(!$bid)
        {
            throw new ProgramInBidNotFound();
        }
        $bid->delete();


        return $bid;
    }

    public static function createListener(ListenerDTO $dto)
    {
        list($surname, $name, $patronymic) = explode(' ', $dto->getFio());
        /** TODO Вместо СНИЛ, либо убрать пароль или уточнить*/
        $user = UserService::registerUser(
            $name,
            $dto->getEmail(),
            $surname,
            $dto->getPhone(),
            $dto->getSnils(),
            $dto->getSnils(),
            $dto->isAvalibleVoSpo(),
            $patronymic,
        );
        $userBids = self::createUserBid((int) $user->id, (int) $dto->getBidId());
        $configListener = self::createConfigListener((int) $userBids->id, (int) $dto->getGroupProgramId());

        return ['user' => $user, 'config_listener' => $configListener];
    }

    public static function deleteListener(int $listenerId)
    {
        $listener = UserBid::where('id', $listenerId)->first();

        if(!$listener)
        {
            throw new SystemError();
        }
        $listener->delete();
        return $listenerId;
    }

    private static function createUserBid(int $userId, int $bidId) : UserBid
    {
        return UserBid::create(['user_id' => $userId, 'bid_id' => $bidId]);
    }

    private static function createConfigListener(int $listenerId, int $groupProgramId): ConfigsListener
    {
        /** TODO при поправить при с добавлением сервисов, а также пересчитывать цену*/
        return ConfigsListener::create([
            'listener_id' => $listenerId,
            'group_programm_id' => $groupProgramId,
            'count_clock' => 100,
            'programm_type' => 'Тест',
            'form_education' => '',
            'type_document' => '',
            'price' => 100,
        ]);
    }
}