<?php

namespace App\Repositories;

use App\Helpers\ChangeDateAndTimeHelper;
use App\Models\Orders\Bids\Bid;
use App\Models\Orders\Bids\StatusBid;
use App\Models\Orders\Bids\UsersBid;
use App\Models\Orders\LoyaltyProgram;
use App\Models\Orders\Order;
use App\Models\Orders\PayerDetail;
use App\Models\Orders\Payment;
use App\Models\Programs\Program;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersRepository
{
    public function getOrderUserList(int $userId, int $page = 1): LengthAwarePaginator
    {
        $orders = Order::select('id', 'created_at')
            ->where(['user_id' => $userId])
            ->paginate(10, ['*'], 'page', $page);

        return $orders;
    }

    public function getOrderUser(int $userId, int $orderId)
    {
        $order = Order::select('id', 'user_id','price','manager_id', 'created_at')
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
        $payment = PayerDetail::select('*')
            ->where(['order_id' => $orderId])
            ->first();
        
        return $payment;
    }

    public function getBidsOrder(int $orderId)
    {
        $bids = Bid::select('*')
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
        $listeners = UsersBid::select('id', 'user_id')
            ->where(['bid_id' => $bidId])
            ->get();

        return $listeners;
    }

    public function getPaymentBid(int $bidId)
    {
        $payment = Payment::select('id', 'document_id', 'payment_method_id', 'percent')
            ->where(['bid_id' => $bidId])
            ->get();

        return $payment;
    }

    public function getLoyalityProgram(int $price)
    {
        $loyalityProgram = LoyaltyProgram::select('id', 'name', 'percent', 'code')
            ->where(['price' => $price])
            ->first();

        return $loyalityProgram;
    }

    public function getOrderById(int $id): Order
    {
        return Order::select('*')
            ->where(['id' => $id])
            ->first();
    }


}