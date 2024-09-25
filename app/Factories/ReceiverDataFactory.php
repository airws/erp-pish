<?php

namespace App\Factories;

use App\Contracts\IReceiverData;
use App\Services\Generators\AgreementForServicesType;

/**
 * Класс ReceiverDataFactory.
 *
 * Фабрика для создания объектов типа IReceiverData.
 */
class ReceiverDataFactory
{
    /**
     * Создает экземпляр IReceiverData соответствующего типа.
     *
     * @param string $type Тип управляемого объекта.
     * @return IReceiverData Возвращает экземпляр IReceiverData соответствующего типа.
     */
    public static function create($type): IReceiverData
    {
        return app(AgreementForServicesType::class);
    }
}
