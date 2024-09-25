<?php

namespace App\Repositories;

use App\Models\Orders\Bids\ConfigsListener;
use App\Models\User;
use App\Models\User\UserExtraOption;

class UserRepository
{
    public function getUserByListenerId(int $listenerId): ?User
    {
        return User::whereHas('usersBids', function($query) use ($listenerId) {
            $query->where('id', $listenerId);
        })->first();
    }

    public function getUserByListenerIds(array $listenerIds): ?User
    {
        return User::whereHas('usersBids', function($query) use ($listenerIds) {
            $query->where('id', $listenerIds);
        })->get();
    }

    /**
     * Получает пользователя по его email.
     *
     * @param string $email Email пользователя.
     * @return User|null Пользователь, если найден, или null, если не найден.
     */
    public function getByEmail(string $email): ?User
    {
        return User::select('id', 'email')->where(['email' => $email])->first();
    }

    /**
     * Получает пользователя по его ID.
     *
     * @param int $userId ID пользователя.
     * @return User Пользователь, соответствующий заданному ID.
     */
    public function getById(int $userId): User
    {
        return User::select('*')->where(['id' => $userId])->first();
    }

    /**
     * Получает основную информацию о пользователе по его ID.
     *
     * @param int $userId ID пользователя.
     * @return User Пользователь с основной информацией.
     */
    public function getUserInfo(int $userId): User
    {
        return User::select('id', 'surname', 'name', 'patronymic', 'email', 'phone')->where(['id' => $userId])->first();
    }

    /**
     * Получает информацию о пользователе в контексте заявки по его ID.
     *
     * @param int $userId ID пользователя.
     * @return User Пользователь с информацией, связанной с заявкой.
     */
    public function getUserInfoInBid(int $userId): User
    {
        return User::select('id', 'surname', 'name', 'patronymic', 'email', 'phone', 'avalible_vo_spo')->where(['id' => $userId])->first();
    }

    /**
     * Получает конфигурацию слушателя по его ID.
     *
     * @param int $listenerId ID слушателя.
     * @return ConfigsListener|null Конфигурация слушателя или null, если не найдено.
     */
    public function getConfigsListener(int $listenerId): ?ConfigsListener
    {
        return ConfigsListener::select('id', 'group_programm_id', 'count_clock', 'programm_type', 'form_education', 'type_document', 'price')
            ->where(['listener_id' => $listenerId])
            ->first();
    }

    /**
     * Получает дополнительные параметры пользователя по его ID.
     *
     * @param int $listenerId ID пользователя (слушателя).
     * @return UserExtraOption Дополнительные параметры пользователя.
     */
    public function getExtraOptionListener(int $listenerId): UserExtraOption
    {
        return UserExtraOption::select('*')
            ->where(['user_id' => $listenerId])
            ->first();
    }
}
