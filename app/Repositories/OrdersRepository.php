<?php

namespace App\Repositories;

use App\Helpers\ChangeDateAndTimeHelper;
use App\Models\Orders\Bids\Bid;
use App\Models\Orders\Bids\StatusBid;
use App\Models\Orders\Bids\UserBid;
use App\Models\Orders\LoyaltyProgram;
use App\Models\Orders\Order;
use App\Models\Orders\PayerDetail;
use App\Models\Orders\Payment;
use App\Models\Orders\StatusOrder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class OrdersRepository
 *
 * Репозиторий для работы с заказами и связанными с ними данными.
 *
 * @package App\Repositories
 */
class OrdersRepository
{
    public function getStatusIdOrderByCode(string $code): int
    {
        return StatusOrder::where('code', $code)->value('id');
    }

    /**
     * Получает список заказов пользователя с пагинацией.
     *
     * @param int $userId Идентификатор пользователя.
     * @param int $page Номер страницы для пагинации.
     * @return LengthAwarePaginator Пагинированный список заказов.
     */
    public function getOrderUserList(int $userId, int $page = 1): LengthAwarePaginator
    {
        return Order::select('id', 'created_at')
            ->where(['user_id' => $userId])
            ->paginate(10, ['*'], 'page', $page);
    }

    /**
     * Получает информацию о конкретном заказе пользователя.
     *
     * @param int $userId Идентификатор пользователя.
     * @param int $orderId Идентификатор заказа.
     * @return Order|null Заказ с добавленной информацией о дате и имени.
     */
    public function getOrderUser(int $userId, int $orderId): ?Order
    {
        $order = Order::select('id', 'user_id', 'price', 'manager_id', 'created_at')
            ->where(['user_id' => $userId])
            ->where(['id' => $orderId])
            ->first();

        if ($order) {
            $order->name = 'Заявка №' . $order->id;
            $order->date_created = ChangeDateAndTimeHelper::changeFormatDateAndTime($order->created_at);
            unset($order->created_at);
        }

        return $order;
    }

    /**
     * Получает детали плательщика для заказа.
     *
     * @param int $orderId Идентификатор заказа.
     * @return PayerDetail|null Детали плательщика.
     */
    public function getPayerDetailsOrder(int $orderId): ?PayerDetail
    {
        return PayerDetail::select('*')
            ->where(['order_id' => $orderId])
            ->first();
    }

    public function getListenerOrder(int $orderId): \Illuminate\Database\Eloquent\Collection
    {
        $bids = $this->getBidsOrder($orderId);
        $bidIds = [];
        foreach ($bids as $bid)
        {
            $bidIds[] = $bid->id;
        }

        return UserBid::select('id', 'user_id')
            ->where(['bid_id' => $bidIds])
            ->get();
    }
    /**
     * Получает список заявок для заказа.
     *
     * @param int $orderId Идентификатор заказа.
     * @return \Illuminate\Database\Eloquent\Collection Список заявок.
     */
    public function getBidsOrder(int $orderId): \Illuminate\Database\Eloquent\Collection
    {
        return Bid::select('*')
            ->where(['order_id' => $orderId])
            ->get();
    }

    /**
     * Получает информацию о статусе заявки.
     *
     * @param int $statusId Идентификатор статуса заявки.
     * @return StatusBid|null Информация о статусе заявки.
     */
    public function getStatusBidInfo(int $statusId): ?StatusBid
    {
        return StatusBid::select('id', 'name', 'code')
            ->where(['id' => $statusId])
            ->first();
    }

    /**
     * Получает список слушателей для заявки.
     *
     * @param int $bidId Идентификатор заявки.
     * @return \Illuminate\Database\Eloquent\Collection Список слушателей.
     */
    public function getListenerBid(int $bidId): \Illuminate\Database\Eloquent\Collection
    {
        return UserBid::select('id', 'user_id')
            ->where(['bid_id' => $bidId])
            ->get();
    }

    /**
     * Получает список платежей для заявки.
     *
     * @param int $bidId Идентификатор заявки.
     * @return \Illuminate\Database\Eloquent\Collection Список платежей.
     */
    public function getPaymentBid(int $bidId): \Illuminate\Database\Eloquent\Collection
    {
        return Payment::select('id', 'document_id', 'payment_method_id', 'percent')
            ->where(['bid_id' => $bidId])
            ->get();
    }

    /**
     * Получает информацию о программе лояльности на основе цены заказа.
     *
     * @param int $price Цена заказа.
     * @return LoyaltyProgram|null Программа лояльности.
     */
    public function getLoyalityProgram(int $price): ?LoyaltyProgram
    {
        return LoyaltyProgram::select('id', 'name', 'percent', 'code')
            ->where(['price' => $price])
            ->first();
    }

    /**
     * Получает заказ по его идентификатору.
     *
     * @param int $id Идентификатор заказа.
     * @return Order|null Заказ.
     */
    public function getOrderById(int $id): ?Order
    {
        return Order::select('*')
            ->where(['id' => $id])
            ->first();
    }
}
