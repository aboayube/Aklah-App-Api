<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});
Route::post('{lang}/register', [App\Http\Controllers\Api\RegisterUserController::class, 'register']);
Route::post('chef/{lang}/register', [App\Http\Controllers\Api\RegisterChefController::class, 'register']);
//login
Route::post('login', [App\Http\Controllers\Api\RegisterUserController::class, 'login']);

Route::get('{lang}/categories', [App\Http\Controllers\Api\CategoriesController::class, 'index']);


Route::get('{lang}/chefs', [App\Http\Controllers\Api\ChefsController::class, 'index']);
Route::get('{lang}/wasfas', [App\Http\Controllers\Api\wasfasController::class, 'index']);


Route::get('{lang}/faqs', [App\Http\Controllers\Api\FaqController::class, 'index']);
//وصفة بشكل تفصيلي
Route::get('{lang}/wasfa/{id}', [App\Http\Controllers\Api\wasfasController::class, 'show']);

//  search
Route::get('{lang}/search/{word}/{type}', [App\Http\Controllers\Api\SearchController::class, 'search']);

Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        Route::post('editprofile',[App\Http\Controllers\Api\RegisterUserController::class, 'editprofile']);
        Route::post('{lang}/address', [App\Http\Controllers\Api\RegisterUserController::class, 'address']);
        Route::post('{lang}/wasfa_user/{id}', [App\Http\Controllers\Api\wasfasController::class, 'store']);
        Route::post('addwasfas', [App\Http\Controllers\Api\wasfasController::class, 'addwasfa']);
        Route::post('{lang}/wasfa/accept/{id}', [App\Http\Controllers\Api\wasfasController::class, 'update_status']);
Route::get('user',[App\Http\Controllers\Api\RegisterUserController::class, 'getUserbyToken']);

        //انواع الطلبات
        //طلبات قيد تنفيذ
        Route::get('{lang}/card', [App\Http\Controllers\Api\OrderController::class, 'card']);
        Route::get('{lang}/order/proccess', [App\Http\Controllers\Api\OrderController::class, 'execute']);
        //دفع
        Route::post('{lang}/card/payment', [OrderController::class, 'payment'])->name('card.payment');

        Route::get('paypal/return', [CheckoutController::class, 'Paypalreturn'])->name('paypal.return');
        Route::get('paypal/cancle', [CheckoutController::class, 'Paypalcancle'])->name('paypal.cancle');
        //تقييم الشيف
        Route::get('{lang}/ratewasfa/{id}', [App\Http\Controllers\Api\RatingController::class, 'ratewasfa']);
        Route::post('{lang}/ratewasfa/{id}', [App\Http\Controllers\Api\RatingController::class, 'postratewasfa']);
        Route::get('{lang}/ratechef/{id}', [App\Http\Controllers\Api\RatingController::class, 'ratewasfa']);
        Route::post('{lang}/ratechef/{id}', [App\Http\Controllers\Api\RatingController::class, 'postratechef']);

        //يعرض قدام شيف
        Route::get('{lang}/wasfa_show/{id}', [App\Http\Controllers\Api\WasfasUserController::class, 'show']);
        Route::get('{lang}/wasfa_show_content/{wasfa_id}', [App\Http\Controllers\Api\WasfasUserController::class, 'show_content']);

        Route::get('{lang}/chef', [App\Http\Controllers\Api\ChefsController::class, 'dashborad']);
        Route::get('{lang}/chef/wasfas', [App\Http\Controllers\Api\ChefsController::class, 'chef_wasfas']);
    }
);
