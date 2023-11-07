<?php

namespace App\Repositories;

use App\Models\Orders\Bids\ConfigsListener;
use App\Models\User;
use App\Models\User\UserExtraOption;

class UserRepository
{
    /**
     * @param string $email
     * @return User
     */
    public function getByEmail(string $email):?User
    {
        return User::select('id', 'email')->where(['email' => $email])->first();
    }

    public function getById(int $userId):User
    {
        return User::select('*')->where(['id' => $userId])->first();
    }

    public function getUserInfo(int $userId):User
    {
        return User::select('id', 'surname', 'name', 'patronymic', 'email', 'phone')->where(['id' => $userId])->first();
    }

    public function getUserInfoInBid(int $userId):User
    {
        return User::select('id', 'surname', 'name', 'patronymic', 'email', 'phone', 'avalible_vo_spo')->where(['id' => $userId])->first();
    }

    public function getConfigsListener(int $listenerId)
    {
        return ConfigsListener::select('id', 'group_programm_id', 'count_clock', 'programm_type', 'form_education', 'type_document', 'price')
            ->where(['listener_id' => $listenerId])
            ->first();
    }

    public function getExtraOptionListener(int $listenerId):UserExtraOption
    {
        return UserExtraOption::select('*')
            ->where(['user_id' => $listenerId])
            ->first();
    }


}