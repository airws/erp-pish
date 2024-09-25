<?php

namespace App\Services;

use App\Events\AccessesByListenerEvent;
use App\Events\RegisterUserEvent;
use App\Exceptions\AuthException;
use App\Exceptions\OrderNotFoundException;
use App\Models\Orders\Order;
use App\Models\Orders\PayerDetail;
use App\Models\Orders\Payment;
use App\Repositories\OrdersRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;
use App\DTO\PayerDetailDTO;
use App\Exceptions\PayerNotFound;
use Illuminate\Support\Str;

/**
 * Class OrdersService
 *
 * Сервис для управления заказами и деталями плательщиков.
 *
 * @package App\Services
 */
class OrdersService
{
    public static function sendOrderVerification(int $orderId, array $paymentMethodIds, array $percents = []): int
    {
        $orderObj = app(OrdersRepository::class);
        /** @var OrdersRepository $orderObj */
        $order = $orderObj->getOrderById($orderId);
        $statusVerificationId = $orderObj->getStatusIdOrderByCode('verif');

        $order->status_id = $statusVerificationId;
        $order->save();

        foreach ($paymentMethodIds as $bidId=>$paymentMethodId)
        {
            Payment::where('bid_id', $bidId)->delete();
            if($percents && $percents[$bidId])
            {
                foreach ($percents[$bidId] as $percent)
                {
                    Payment::create(
                        [
                            'document_id' => 1,
                            'bid_id' => $bidId,
                            'payment_method_id' => $paymentMethodId,
                            'percent' => $percent,
                        ]
                    );
                }
            } else {
                Payment::updateOrCreate(
                    ['bid_id' => $bidId],[
                        'document_id' => 1,
                        'bid_id' => $bidId,
                        'payment_method_id' => $paymentMethodId,
                        'percent' => 0,
                    ]
                );
            }
        }


        return $order->id;
    }

    public static function changeStatus(int $orderId, int $statusId): int
    {
        $orderObj = app(OrdersRepository::class);
        /** @var OrdersRepository $orderObj */
        $order = $orderObj->getOrderById($orderId);

        $order->status_id = $statusId;
        $order->save();

        return $order->id;
    }

    public static function getAccessesByListener(int $listenerId): int
    {
        $userObj = app(UserRepository::class);
        /** @var UserRepository $userObj*/
        $user = $userObj->getUserByListenerId($listenerId);
        $password = Str::random(10); // generate random password
        $user->password = bcrypt($password); // generate random password
        $user->save();
        
        AccessesByListenerEvent::dispatch($user, $password, env('APP_URL').'login');

        return $user->id;
    }

    /**
     * Получает детали заказа для пользователя.
     *
     * @param int $orderId Идентификатор заказа.
     * @param $user Объект пользователя.
     * @return mixed Объект заказа с детализированной информацией.
     */
    public static function getDetailOrder(int $orderId, $user)
    {
        $orderObject = app(OrdersRepository::class);
        $price = 0;
        /** @var OrdersRepository $orderObject */
        $order = $orderObject->getOrderUser($user->id, $orderId);
        if(!$order)
        {
            throw new OrderNotFoundException();
        }
        /** TODO добавить менеджеру получение аватарки и ссылку на чат*/
        $userObject = app(UserRepository::class);
        /** @var UserRepository $userObject */
        $order->manager = $userObject->getUserInfo($order->manager_id);
        $order->payment = $orderObject->getPayerDetailsOrder($order->id);
        $order->bids = $orderObject->getBidsOrder($order->id);
        $programRepository = app(ProgramRepository::class);
        /** @var ProgramRepository $programRepository */

        foreach ($order->bids as &$bid) {
            $bid->status = $orderObject->getStatusBidInfo($bid->status_id);
            $bid->programm = $programRepository->getProgram($bid->program_id);
            $bid->listeners = $orderObject->getListenerBid($bid->id);
            foreach ($bid->listeners as &$listener) {
                $listener->info = $userObject->getUserInfoInBid($listener->user_id);
                $listener->configs = $userObject->getConfigsListener($listener->id);
                if($listener->configs)
                {
                    $listener->configs->blocks = $programRepository->getBlocksFromGroup($listener->configs->group_programm_id);
                    $price += $listener->configs->price;
                }
            }
            $bid->payment = $orderObject->getPaymentBid($bid->id);
        }
        $order->price = $price;
        if ($loyalityProgram = $orderObject->getLoyalityProgram($order->price)) {
            $order->loyalityProgram = $loyalityProgram;
            $order->priceDiscont = $order->price - ($order->price * ($loyalityProgram->percent / 100));
        }
        return $order;
    }

    /**
     * Создает новую запись о плательщике.
     *
     * @param PayerDetailDTO $dto Объект передачи данных (DTO) для плательщика.
     * @return PayerDetail Созданная запись плательщика.
     * @throws PayerDetailUpdateException Если не удалось сохранить данные плательщика.
     */
    public static function createPayerDetail(PayerDetailDTO $dto): PayerDetail
    {
        $payer = new PayerDetail();
        self::fillFieldsPayerDetail($dto, $payer);

        try {
            if (!$payer->save()) {
                throw new PayerDetailUpdateException("Не удалось сохранить данные плательщика.");
            }
        } catch (\Exception $e) {
            throw new PayerDetailUpdateException("Ошибка сохранения данных плательщика: " . $e->getMessage(), 0, $e);
        }

        return $payer;
    }

    /**
     * Обновляет запись о плательщике.
     *
     * @param PayerDetailDTO $dto Объект передачи данных (DTO) для плательщика.
     * @param int $id Идентификатор записи плательщика.
     * @return PayerDetail Обновленная запись плательщика.
     * @throws PayerDetailUpdateException Если не удалось сохранить данные плательщика.
     */
    public static function updatePayerDetail(PayerDetailDTO $dto, int $id): PayerDetail
    {
        $payer = PayerDetail::find($id);
        self::fillFieldsPayerDetail($dto, $payer);

        try {
            if (!$payer->save()) {
                throw new PayerDetailUpdateException("Не удалось сохранить данные плательщика.");
            }
        } catch (\Exception $e) {
            throw new PayerDetailUpdateException("Ошибка сохранения данных плательщика: " . $e->getMessage(), 0, $e);
        }

        return $payer;
    }

    /**
     * Получает детали плательщика по идентификатору заказа.
     *
     * @param int $orderId Идентификатор заказа.
     * @return PayerDetail Объект с деталями плательщика.
     * @throws PayerNotFound Если плательщик не найден.
     */
    public static function getPayer(int $orderId) : PayerDetail
    {
        $payer = PayerDetail::where('order_id', $orderId)->first();
        if(!$payer)
        {
            throw new PayerNotFound();
        }

        return $payer;
    }

    /**
     * Заполняет поля объекта плательщика данными из DTO.
     *
     * @param PayerDetailDTO $dto Объект DTO с данными плательщика.
     * @param PayerDetail $payer Объект плательщика, который будет заполнен данными.
     * @return PayerDetail Заполненный объект плательщика.
     */
    private static function fillFieldsPayerDetail(PayerDetailDTO $dto, PayerDetail $payer): PayerDetail
    {
        $payer->order_id = $dto->getOrderId();
        $payer->bik_bank = $dto->getBikBank();
        $payer->name_bank = $dto->getNameBank();
        $payer->rc = $dto->getRc();
        $payer->ks = $dto->getKs();
        $payer->kbk = $dto->getKbk();
        $payer->personal_account = $dto->getPersonalAccount();
        $payer->actual_address = $dto->getActualAddress();
        $payer->ur_address = $dto->getUrAddress();
        $payer->type_face = $dto->getTypeFace();
        $payer->inn = $dto->getInn();
        $payer->kpp = $dto->getKpp();
        $payer->ogrn = $dto->getOgrn();
        $payer->city = $dto->getCity();
        $payer->index = $dto->getIndex();
        $payer->abbreviation = $dto->getAbbreviation();
        $payer->full_ur_name = $dto->getFullUrName();
        $payer->fio_rod_head = $dto->getFioRodHead();
        $payer->fio_head = $dto->getFioHead();
        $payer->job_title = $dto->getJobTitle();
        $payer->acts_basis = $dto->getActsBasis();
        $payer->concluded_accordance = $dto->getConcludedAccordance();
        $payer->surname = $dto->getSurname();
        $payer->name = $dto->getName();
        $payer->patronymic = $dto->getPatronymic();
        $payer->snils = $dto->getSnils();
        $payer->registration_address = $dto->getRegistrationAddress();

        return $payer;
    }

}