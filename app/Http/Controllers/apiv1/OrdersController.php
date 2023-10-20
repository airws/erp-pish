<?php

namespace App\Http\Controllers\apiv1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResources;
use App\Http\Resources\OrdersUserListResources;
use App\Http\Resources\RegisterResources;
use App\Repositories\OrdersRepository;
use App\Repositories\UserRepository;
use App\Services\OrdersService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getUserOrdersList(Request $request)
    {
        /** Тут список заказов*/

        $ordersObject = app(OrdersRepository::class);
        $orders = $ordersObject->getOrderUserList($request->user()->id, (int)$request->page);

        return OrdersUserListResources::collection($orders);
    }

    public function getOrderDetail($orderId, Request $request)
    {
        /** Тут деталка заказа*/

        $user = $request->user();
        $order = OrdersService::getDetailOrder($orderId, $user);

        return new OrderDetailResources($order);
    }

}
