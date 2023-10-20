<?php

namespace App\Repositories;

use App\Helpers\ChangeDateAndTimeHelper;
use App\Models\Orders\Bids\Bids;
use App\Models\Orders\Bids\StatusBid;
use App\Models\Orders\Bids\UsersBids;
use App\Models\Orders\LoyaltyPrograms;
use App\Models\Orders\Orders;
use App\Models\Orders\PayerDetails;
use App\Models\Orders\Payments;
use App\Models\Programs\Programs;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersRepository
{
    public function getOrderUserList(int $userId, int $page = 1): LengthAwarePaginator
    {
        $orders = Orders::select('id', 'created_at')
            ->where(['user_id' => $userId])
            ->paginate(10, ['*'], 'page', $page);

        return $orders;
    }

    public function getOrderUser(int $userId, int $orderId)
    {
        $order = Orders::select('id', 'user_id','price','manager_id', 'created_at')
            ->where(['user_id' => $userId])
            ->where(['id' => $orderId])
            ->first();

        $order->name = 'Заявка №'.$order->id;
        $order->date_created = ChangeDateAndTimeHelper::changeFormatDateAndTime($order->created_at);
        unset($order->created_at);

        return $order;
    }

    public function getPayerDetailsOrder(int $orderId)
    {
        $payment = PayerDetails::select('*')
            ->where(['order_id' => $orderId])
            ->first();
        
        return $payment;
    }

    public function getBidsOrder(int $orderId)
    {
        $bids = Bids::select('*')
            ->where(['order_id' => $orderId])
            ->get();

        return $bids;
    }

    public function getStatusBidInfo(int $statusId)
    {
        $statusInfo = StatusBid::select('id', 'name', 'code')
            ->where(['id' => $statusId])
            ->first();

        return $statusInfo;
    }

    public function getListenerBid(int $bidId)
    {
        $listeners = UsersBids::select('id', 'user_id')
            ->where(['bid_id' => $bidId])
            ->get();

        return $listeners;
    }

    public function getPaymentBid(int $bidId)
    {
        $payment = Payments::select('id', 'document_id', 'payment_method_id', 'percent')
            ->where(['bid_id' => $bidId])
            ->get();

        return $payment;
    }

    public function getLoyalityProgram(int $price)
    {
        $loyalityProgram = LoyaltyPrograms::select('id', 'name', 'percent', 'code')
            ->where(['price' => $price])
            ->first();

        return $loyalityProgram;
    }
}