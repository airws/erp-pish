<?php

namespace App\Http\Controllers\apiv1;

use App\Events\GenerateDocumentEvent;
use App\Events\UpdateUserPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResources;
use App\Http\Resources\OrdersUserListResources;
use App\Http\Resources\PaymentMethodsResource;
use App\Http\Resources\RegisterResources;
use App\Models\Files\TypesTemplate;
use App\Repositories\OrdersRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use App\Services\OrdersService;
use Illuminate\Http\Request;
use App\Repositories\FileRepository;
use App\Http\Resources\CreateOrderResources;
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

    public function getPaymentMethods()
    {
        $payment = app(PaymentRepository::class);
        /* @var PaymentRepository $payment */

        return PaymentMethodsResource::collection($payment->getPaymentMethods());
    }

    public function createOrder(Request $request)
    {

        GenerateDocumentEvent::dispatch(TypesTemplate::select('id', 'name', 'code')->where(['code' => 'AgreementForServices'])->first(), 1);
        $file = FileRepository::getLastFile();
        
        return new CreateOrderResources($file);

    }

}
