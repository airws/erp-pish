<?php

namespace App\Factories;

use App\Contracts\IReceiverData;
use App\Services\Generators\AgreementForServicesType;

class ReceiverDataFactory
{
    public static function create($type): IReceiverData
    {
        return app(AgreementForServicesType::class);
    }
}