<?php

namespace App\Repositories;

use App\Models\Orders\Payment;
use App\Models\Orders\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;
class PaymentRepository
{
    public function getPaymentMethods(): Collection
    {
        return PaymentMethod::select('id', 'name', 'code', 'active')->where(['active' => 1])->get();
    }
}