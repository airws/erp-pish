<?php

namespace App\Repositories;

use App\Models\Orders\Payment;
use App\Models\Orders\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий для работы с моделью оплаты.
 *
 * Этот класс содержит методы для получения данных об оплате из базы данных.
 */
class PaymentRepository
{
    /**
     * Получить методы оплаты, которые активны.
     *
     * @return Collection Возвращает коллекцию активных методов оплаты.
     */
    public function getPaymentMethods(): Collection
    {
        return PaymentMethod::select('id', 'name', 'code', 'active')->where(['active' => 1])->get();
    }
}
