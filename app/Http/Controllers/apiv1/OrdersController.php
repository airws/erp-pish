<?php

namespace App\Http\Controllers\apiv1;

use App\Events\GenerateDocumentEvent;
use App\Events\UpdateUserPasswordEvent;
use App\Exceptions\DaDataNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccessesByListenerRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\SearchToBikRequest;
use App\Http\Requests\SearchToInnRequest;
use App\Http\Requests\SendOrderVerificationRequest;
use App\Http\Resources\AccessesByListenerResource;
use App\Http\Resources\ChangeStatusResource;
use App\Http\Resources\GetDetailsResources;
use App\Http\Resources\OrderDetailResources;
use App\Http\Resources\OrdersUserListResources;
use App\Http\Resources\PaymentMethodsResource;
use App\Http\Resources\RegisterResources;
use App\Http\Resources\SearchToBikResources;
use App\Http\Resources\SearchToInnResources;
use App\Http\Resources\SendOrderVerificationResource;
use App\Models\Files\TypesTemplate;
use App\Repositories\OrdersRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use App\Services\DaDataService;
use App\Services\OrdersService;
use Illuminate\Http\Request;
use App\Repositories\FileRepository;
use App\Http\Resources\CreateOrderResources;
use App\Http\Requests\CreatePayerDetailRequest;
use App\DTO\PayerDetailDTO;

/**
 * Class OrdersController
 *
 * @package App\Http\Controllers\apiv1
 */
class OrdersController extends Controller
{
    public function changeStatus(ChangeStatusRequest $request)
    {
        $orderId = OrdersService::changeStatus($request->order_id, $request->status_id);

        return new ChangeStatusResource($orderId);
    }
    public function sendOrderVerification(SendOrderVerificationRequest $request)
    {
        $orderId = OrdersService::sendOrderVerification($request->order_id, $request->payment_method_id, $request->percent);

        return new SendOrderVerificationResource($orderId);
    }

    public function getAccessesByListener(AccessesByListenerRequest $request)
    {
        $listenerId = OrdersService::getAccessesByListener($request->listener_id);

        return new AccessesByListenerResource($listenerId);
    }


    /**
     * Получает список заказов пользователя.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserOrdersList(Request $request)
    {
        $ordersObject = app(OrdersRepository::class);
        $orders = $ordersObject->getOrderUserList($request->user()->id, (int)$request->page);

        return OrdersUserListResources::collection($orders);
    }

    /**
     * Получает детальную информацию о заказе.
     *
     * @param int $orderId
     * @param Request $request
     * @return OrderDetailResources
     */
    public function getOrderDetail($orderId, Request $request)
    {
        $user = $request->user();
        $order = OrdersService::getDetailOrder($orderId, $user);

        return new OrderDetailResources($order);
    }

    /**
     * Получает список методов оплаты.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getPaymentMethods()
    {
        $payment = app(PaymentRepository::class);

        return PaymentMethodsResource::collection($payment->getPaymentMethods());
    }

    /**
     * Создает заказ и возвращает созданный файл.
     *
     * @param Request $request
     * @return CreateOrderResources
     */
    public function createOrder(Request $request)
    {
        GenerateDocumentEvent::dispatch(TypesTemplate::select('id', 'name', 'code')->where(['code' => 'AgreementForServices'])->first(), 1);
        $file = FileRepository::getLastFile();

        return new CreateOrderResources($file);
    }

    /**
     * Создает данные плательщика.
     *
     * @param CreatePayerDetailRequest $request
     * @return OrderDetailResources
     */
    public function createPayerDetail(CreatePayerDetailRequest $request)
    {
        $dto = new PayerDetailDTO($request->validated());
        $payerDetail = OrdersService::createPayerDetail($dto);

        return new OrderDetailResources($payerDetail);
    }

    /**
     * Обновляет данные плательщика.
     *
     * @param int $payerId
     * @param CreatePayerDetailRequest $request
     * @return OrderDetailResources
     */
    public function updatePayerDetail($payerId, CreatePayerDetailRequest $request)
    {
        $dto = new PayerDetailDTO($request->validated());
        $payerDetail = OrdersService::updatePayerDetail($dto, (int) $payerId);

        return new OrderDetailResources($payerDetail);
    }

    /**
     * Получает данные плательщика по ID заказа.
     *
     * @param int $orderId
     * @return GetDetailsResources
     */
    public function getPayer($orderId)
    {
        return new GetDetailsResources(OrdersService::getPayer((int) $orderId));
    }

    /**
     * Поиск организаций по ИНН через DaData.
     *
     * @param SearchToInnRequest $request
     * @return SearchToInnResources
     *
     * @throws DaDataNotFound
     */
    public function searchToInn(SearchToInnRequest $request)
    {
        $daData = app(DaDataService::class);
        $daDataInfo = $daData->getCompaniesByInn($request->q);

        return new SearchToInnResources($daDataInfo);
    }

    /**
     * Поиск банков по БИК через DaData.
     *
     * @param SearchToBikRequest $request
     * @return SearchToBikResources
     *
     * @throws DaDataNotFound
     */
    public function searchToBik(SearchToBikRequest $request)
    {
        $daData = app(DaDataService::class);
        $daDataInfo = $daData->getBanksByBik($request->q);
        
        return new SearchToBikResources($daDataInfo);
    }
}
