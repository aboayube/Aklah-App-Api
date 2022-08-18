<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\SupervisorsController;
use App\Http\Controllers\Admin\WasfaController;
use App\Http\Controllers\Admin\WasfaContentController;
use  App\Http\Controllers\Admin\UserController;
use  App\Http\Controllers\ContactusController;
use  App\Http\Controllers\Admin\OrderWasfasCotnroller;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(
            [
                'prefix' => '/admin/', 'as' => 'admin.',
                'middleware' => ['auth', 'isAdmin']
            ],
            function () {


                Route::get('/dashboard', function () {
                    return view('dashboard');
                })->name('dashboard');
                //roles    
                Route::group(
                    ['prefix' => '/roles/', 'as' => 'roles.'],
                    function () {
                        Route::get('/', [RoleController::class, 'index'])->name('index');
                        Route::post('/store', [RoleController::class, 'store'])->name('store');
                        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                        Route::patch('/update/{id}', [RoleController::class, 'update'])->name('update');
                        Route::post('/delete', [RoleController::class, 'destroy'])->name('delete');
                    }
                );
                //chefs
                Route::group(['prefix' => '/chef', 'as' => 'chefs.'], function () {
                    Route::get('/', [ChefController::class, 'index'])->name('index');
                    Route::post('/store', [ChefController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [ChefController::class, 'edit'])->name('edit');
                    Route::post('/update', [ChefController::class, 'update'])->name('update');
                    Route::post('/delete', [ChefController::class, 'destroy'])->name('delete');
                });
                Route::group([
                    'prefix' => '/users',
                    'as' => 'users.'
                ],  function () {
                    Route::get('/', [UserController::class, 'index'])->name('index');
                    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
                    Route::post('/update', [UserController::class, 'update'])->name('update');
                    Route::post('/delete', [UserController::class, 'destroy'])->name('delete');
                });
                Route::group([
                    'prefix' => '/supervisors',
                    'as' => 'supervisors.'
                ],  function () {
                    Route::get('/', [SupervisorsController::class, 'index'])->name('index');
                    Route::post('/store', [SupervisorsController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [SupervisorsController::class, 'edit'])->name('edit');
                    Route::post('/update', [SupervisorsController::class, 'update'])->name('update');
                    Route::post('/delete', [SupervisorsController::class, 'destroy'])->name('delete');
                });
                //اعدادات الموقع
                Route::group([
                    'prefix' => '/settings',
                    'as' => 'settings.'
                ],  function () {
                    Route::get('/', [SettingController::class, 'index'])->name('index');
                    Route::post('/', [SettingController::class, 'update'])->name('update');
                    Route::get('/', [SettingController::class, 'index'])->name('index');
                });
                //contact us
                Route::group([
                    'prefix' => '/contactus',
                    'as' => 'contactus.'
                ],  function () {
                    Route::get('/', [ContactusController::class, 'index'])->name('index');
                    Route::post('/delete', [ContactusController::class, 'delete'])->name('delete');
                });

                //faq 

                Route::group([
                    'prefix' => '/faq',
                    'as' => 'faq.'
                ], function () {


                    Route::get('/', [FaqController::class, 'index'])->name('index');
                    Route::post('/store', [FaqController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('edit');
                    Route::post('/update', [FaqController::class, 'update'])->name('update');
                    Route::post('/delete', [FaqController::class, 'destroy'])->name('delete');
                });

                //categories
                Route::group([
                    'prefix' => '/categories',
                    'as' => 'categories.'
                ],  function () {
                    Route::get('/', [CategoriesController::class, 'index'])->name('index');
                    Route::post('/store', [CategoriesController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
                    Route::post('/update', [CategoriesController::class, 'update'])->name('update');
                    Route::post('/delete', [CategoriesController::class, 'destroy'])->name('delete');
                });



                //wasfas
                Route::group([
                    'prefix' => '/wasfa',
                    'as' => 'wasfas.'
                ],  function () {
                    Route::get('/', [WasfaController::class, 'index'])->name('index');
                    Route::get("/create", [WasfaController::class, 'create'])->name('create');
                    Route::post('/store', [WasfaController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [WasfaContentController::class, 'show'])->name('show');
                    Route::get('/edit/{id}', [WasfaController::class, 'edit'])->name('edit');
                    Route::post('/update', [WasfaController::class, 'update'])->name('update');
                    Route::post('/delete', [WasfaController::class, 'destroy'])->name('delete');
                });
                //wasfas content
                Route::group([
                    'prefix' => '/wasfacontent',
                    'as' => 'wasfacontent.'
                ],  function () {
                    Route::post('/store', [WasfaContentController::class, 'store'])->name('store');
                    Route::get('/edit/{wasfa_id}/{id}', [WasfaContentController::class, 'edit'])->name('edit');
                    Route::post('/update', [WasfaContentController::class, 'update'])->name('update');
                    Route::post('/delete', [WasfaContentController::class, 'destroy'])->name('delete');
                });



                //تقييمات الطباخين
                Route::get('ratting/chefs', [RatingController::class, 'chefs'])->name('ratting.chefs');
                Route::get('ratting/wasfas', [RatingController::class, 'wasfas'])->name('ratting.wasfas');

                //طلب مستخدمين الوصفات
                Route::get('/orders/wasfas', [OrderWasfasCotnroller::class, 'index'])->name('orders.wasfas');
                Route::get('/orders/wasfas/{id}', [OrderWasfasCotnroller::class, 'show'])->name('orders.show');
                Route::post('/orders/wasfas', [OrderWasfasCotnroller::class, 'update'])->name('orders.update');
           }
        );
    }
);
