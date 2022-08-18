<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChefControllers;
use App\Http\Controllers\WasfaController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RattingController;
use App\Http\Controllers\UserController;
/* use App\Http\Controllers\ContactusController; */
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'googleLogin'])->name('loginGoogle');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'googleLoginredirect'])->name('login.google.redirect');

Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'facebookLogin'])->name('loginfacebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'facebookLoginredirect'])->name('login.facebook.redirect');

require __DIR__ . '/auth.php';
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::get('statusUpdate', function () {
            if (auth()->user()->status == 1) {
                return redirect()->route('home');
            }
            return view('auth.statusUpdate');
        })->name('statusUpdate');

        /*   Route::get("contactus", [ContactusController::class, 'create'])->name('contactus');
        Route::post("contactus", [ContactusController::class, 'store'])->name('contactus.store');

*/

        Route::get('paypal/return', [CheckoutController::class, 'Paypalreturn'])->name('paypal.return');
        Route::get('paypal/cancle', [CheckoutController::class, 'Paypalcancle'])->name('paypal.cancle');


        Route::get('chefs', [ChefControllers::class, 'index'])->name('chefs.index');
        Route::get('chefs/{id}', [ChefControllers::class, 'chef'])->name('chefs.chef');

        Route::get('wasfas', [WasfaController::class, 'index'])->name('wasfas.index');
        Route::get('wasfa/{id}', [WasfaController::class, 'show'])->name('wasfas.show');

        Route::group(['middleware' => 'auth'], function () {
            Route::post('wasfa/{id}', [WasfaController::class, 'store'])->name('wasfas.store');
            //card
            Route::get('card', [CardController::class, 'index'])->name('card.index');
            Route::get('card/delete/{id}', [CardController::class, 'delete'])->name('card.delete');
            Route::post('card/payment', [CardController::class, 'payment'])->name('card.payment');

            //طلباتي
            Route::get('orders', [OrdersController::class, 'index'])->name('orders.index');

            //تقييم  
            Route::post('rate/wasfa', [RattingController::class, 'ratewasfa'])->name('orders.ratewasfa');
            Route::post('rate/chef', [RattingController::class, 'ratechef'])->name('orders.ratechef');

            Route::post('rate/post/wasfa', [RattingController::class, 'postratewasfa'])->name('orders.ratewasfa.post');
            Route::post('rate/post/chef', [RattingController::class, 'postratechef'])->name('orders.ratechef.post');


            Route::get("profile", [UserController::class, 'profile'])->name('profile');
        });
    }
);
