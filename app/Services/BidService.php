<?php

namespace App\Services;

use App\DTO\ListenerDTO;
use App\Exceptions\ProgramInBidNotFound;
use App\Exceptions\SystemError;
use App\Models\Orders\Bids\Bid;
use App\Models\Orders\Bids\ConfigsListener;
use App\Models\Orders\Bids\UserBid;
use App\Models\Programs\Program;
use App\Models\User;
use App\Repositories\ConfigsListenerRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;

/**
 * Class BidService
 *
 * Сервис для управления программами в заявках и слушателями.
 *
 * @package App\Services
 */
class BidService
{
    public static function joinListenerInBid(array $listenerIds, int $bidId)
    {
        /** @var UserRepository $userObj */
        /** @var ConfigsListenerRepository $configObj */
        $userObj = new UserRepository();
        $configObj = new ConfigsListenerRepository();

        $listenerNewIds = [];
        foreach ($listenerIds as $listenerId) {
            $user = $userObj->getUserByListenerId($listenerId);
            $configs = $configObj->getConfigsByListenerId($listenerId);
            $userBids = self::createUserBid((int)$user->id, (int)$bidId);
            foreach ($configs as $config) {
                $configsListener[] = self::createConfigListener((int)$userBids->id, (int)$config->group_programm_id);
            }
            $listenerNewIds[] = $userBids->id;
        }

        return $listenerNewIds;
    }

    public static function getProgramById(int $programId): Program
    {
        $programObject = app(ProgramRepository::class);

        $program = $programObject->getProgram($programId);

        return $program;
    }

    public static function getListenerById($listenerId)
    {
        $userObj = app(UserRepository::class);
        $configsObj = app(ConfigsListenerRepository::class);
        /** @var UserRepository $userObj */
        $user = $userObj->getUserByListenerId($listenerId);
        $configsListener = $configsObj->getConfigsByListenerId($listenerId);

        return ['user' => $user, 'config_listener' => $configsListener];
    }

    public static function updateListener(ListenerDTO $dto)
    {
        $userObj = app(UserRepository::class);
        /** @var UserRepository $userObj */
        $user = $userObj->getUserByListenerId($dto->getListenerId());
        $userBids = UserService::updateUser($user, $dto->getName(), $dto->getEmail(), $dto->getSurname(), $dto->getPhone(), $dto->getSnils(), $dto->isAvalibleVoSpo(), $dto->getPatronymic());
        $deleteConfigs = self::deleteConfigurationByListener($dto->getListenerId());
        foreach ($dto->getGroupProgramId() as $groupProgram) {
            $configsListener[] = self::createConfigListener((int)$dto->getListenerId(), (int)$groupProgram);
        }


        return ['listener_id' => $userBids->id, 'user' => $user, 'config_listener' => $configsListener];
    }

    public static function createBid(
        int   $orderId,
        int   $programId,
        array $userIds,
        array $groupProgramIds,
        array $surname = [],
        array $name = [],
        array $patronymic = [],
        array $phone = [],
        array $email = [],
        array $snils = [],
        array $avalibleVoSpo = [],
    )
    {
        if ($surname && $name && $phone && $email && $snils && $avalibleVoSpo) {
            foreach ($surname as $key => $surnameUser) {
                $userIds[$key] = UserService::registerUser(
                    $name[$key],
                    $email[$key],
                    $surnameUser,
                    $phone[$key],
                    $snils[$key],
                    (bool)$avalibleVoSpo[$key],
                    $patronymic ? $patronymic[$key] : '',
                )->id;
            }
        }

        $bid = Bid::create([
            'order_id' => $orderId,
            'program_id' => $programId,
            'status_id' => 1,
        ]);

        foreach ($userIds as $key => $userId) {
            $listeners[$key] = UserBid::create([
                'user_id' => $userId,
                'bid_id' => $bid->id,
            ]);
        }

        foreach ($listeners as $key => $listener) {
            foreach ($groupProgramIds[$key] as $groupProgramId) {
                ConfigsListener::create([
                    'listener_id' => $listener->id,
                    'group_programm_id' => $groupProgramId,
                    'count_clock' => 0,
                    'programm_type' => 'default_type',
                    'form_education' => 'default_form',
                    'type_document' => 'default_document',
                    'price' => 0,
                ]);
            }
        }

        return $bid->id;
    }

    public static function searchProgram(string $q): \Illuminate\Database\Eloquent\Collection
    {
        $programObject = app(ProgramRepository::class);

        $programList = $programObject->searchProgram($q);

        return $programList;
    }

    /**
     * Получает список слушателей в заявке.
     *
     * @param string $bidId Идентификатор заявки.
     * @return array Возвращает массив с информацией слушателя в заявке.
     */
    public static function listListers(string $orderId): array
    {
        $orderObject = app(OrdersRepository::class);
        $userObject = app(UserRepository::class);
        $programRepository = app(ProgramRepository::class);

        $listeners = $orderObject->getListenerOrder((int)$orderId);
        $listenersData = [];
        $listenersData['price'] = 0;

        foreach ($listeners as &$listener) {
            $listenersData['listeners'][$listener->user_id]['listener_id'] = $listener->id;
            $listenersData['listeners'][$listener->user_id]['info'] = $userObject->getUserInfoInBid($listener->user_id);
            $configs = $userObject->getConfigsListener($listener->id);
            if ($configs) {
                $listenersData['listeners'][$listener->user_id]['configs'] = $configs;
                $listenersData['listeners'][$listener->user_id]['configs']['blocks'] = $programRepository->getBlocksFromGroup($configs->group_programm_id);
                $listenersData['price'] += $configs->price;
            }
        }


        return $listenersData;
    }

    private static function deleteConfigurationByListener(int $listenerId)
    {
        $configs = ConfigsListener::where('listener_id', $listenerId)->get();

        if (!$configs) {
            throw new ProgramInBidNotFound();
        }
        foreach ($configs as $config) {
            $config->delete();
        }

        return $configs;
    }


    /**
     * Удаляет программу из заявки.
     *
     * @param string $id Идентификатор программы.
     * @param string $bidId Идентификатор заявки.
     * @return Bid Возвращает объект удаленной программы.
     * @throws ProgramInBidNotFound Если программа в заявке не найдена.
     */
    public static function deleteProgram(string $id, string $bidId): Bid
    {
        $bid = Bid::where(['id' => $bidId, 'program_id' => $id])->first();
        if (!$bid) {
            throw new ProgramInBidNotFound();
        }
        $bid->delete();

        return $bid;
    }

    /**
     * Создает слушателя для программы в заявке.
     *
     * @param ListenerDTO $dto Объект передачи данных (DTO) для слушателя.
     * @return array Возвращает массив с информацией о пользователе и настройках слушателя.
     */
    public static function createListener(ListenerDTO $dto)
    {
        // TODO: Уточнить использование СНИЛСа в качестве пароля.
        $user = UserService::registerUser(
            $dto->getName(),
            $dto->getEmail(),
            $dto->getSurname(),
            $dto->getPhone(),
            $dto->getSnils(),
            $dto->getSnils(),
            $dto->isAvalibleVoSpo(),
            $dto->getPatronymic(),
        );
        $userBids = self::createUserBid((int)$user->id, (int)$dto->getBidId());
        foreach ($dto->getGroupProgramId() as $groupProgram) {
            $configsListener[] = self::createConfigListener((int)$userBids->id, (int)$groupProgram);
        }


        return ['listener_id' => $userBids->id, 'user' => $user, 'config_listener' => $configsListener];
    }

    /**
     * Удаляет слушателя по идентификатору.
     *
     * @param int $listenerId Идентификатор слушателя.
     * @return int Возвращает идентификатор удаленного слушателя.
     * @throws SystemError Если слушатель не найден.
     */
    public static function deleteListener(int $listenerId)
    {
        $listener = UserBid::where('id', $listenerId)->first();

        if (!$listener) {
            throw new SystemError();
        }
        $listener->delete();
        return $listenerId;
    }

    /**
     * Создает запись слушателя в заявке.
     *
     * @param int $userId Идентификатор пользователя.
     * @param int $bidId Идентификатор заявки.
     * @return UserBid Возвращает объект UserBid.
     */
    private static function createUserBid(int $userId, int $bidId): UserBid
    {
        return UserBid::create(['user_id' => $userId, 'bid_id' => $bidId]);
    }

    /**
     * Создает настройки слушателя для программы.
     *
     * @param int $listenerId Идентификатор слушателя.
     * @param int $groupProgramId Идентификатор группы программы.
     * @return ConfigsListener Возвращает объект ConfigsListener.
     */
    private static function createConfigListener(int $listenerId, int $groupProgramId): ConfigsListener
    {
        // TODO: Обновить при добавлении новых сервисов и пересчете цены.
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
