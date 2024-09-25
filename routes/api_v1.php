<?php

use App\Http\Controllers\apiv1\FileController;
use App\Http\Controllers\apiv1\OrdersController;
use App\Http\Controllers\apiv1\BidsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiv1\AuthController;
use App\Http\Controllers\apiv1\DocumentsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/forgotpassword', [AuthController::class, 'forgotPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrdersController::class, 'getUserOrdersList']);
    Route::post('/orders/{orderId}', [OrdersController::class, 'getOrderDetail'])->where('orderId', '[0-9]+');
    Route::post('/orders/getPayer/{orderId}', [OrdersController::class, 'getPayer'])->where('orderId', '[0-9]+');
    Route::post('/orders/searchToInn/', [OrdersController::class, 'searchToInn']);
    Route::post('/orders/sendOrderVerification/', [OrdersController::class, 'sendOrderVerification']);
    Route::post('/orders/changeStatus/', [OrdersController::class, 'changeStatus']);
    Route::post('/orders/searchToBik/', [OrdersController::class, 'searchToBik']);
    Route::post('/orders/getAccessesByListener', [OrdersController::class, 'getAccessesByListener']);
    Route::post('/orders/bids/deleteProgram', [BidsController::class, 'deleteProgramInBids']);
    Route::post('/orders/bids/deleteListener/{listenerId}', [BidsController::class, 'deleteListener'])->where('listenerId', '[0-9]+');
    Route::post('/orders/bids/createListener', [BidsController::class, 'createListener']);
    Route::post('/orders/bids/updateListener', [BidsController::class, 'updateListener']);
    Route::post('/orders/bids/getListenerById', [BidsController::class, 'getListenerById']);
    Route::post('/orders/bids/getProgramById', [BidsController::class, 'getProgramById']);
    Route::post('/orders/bids/listListeners', [BidsController::class, 'listListeners']);
    Route::post('/orders/bids/joinListenerInBid', [BidsController::class, 'joinListenerInBid']);
    Route::post('/orders/bids/searchProgram', [BidsController::class, 'searchProgram']);
    Route::post('/orders/createBid', [BidsController::class, 'createBid']);
    Route::post('/upload', [FileController::class, 'upload']);
    Route::post('/getDocument', [DocumentsController::class, 'createDocumentsTemplate'] );
    Route::post('/createOrder', [OrdersController::class, 'createOrder'] );
    Route::post('/getPaymentMethods', [OrdersController::class, 'getPaymentMethods'] );
    Route::post('/orders/createPayerDetail', [OrdersController::class, 'createPayerDetail'] );
    Route::post('/orders/updatePayerDetail/{payerId}', [OrdersController::class, 'updatePayerDetail'] );
});
