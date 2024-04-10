<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\api\CashierController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\SuperuserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
// Route::group(['middleware' => ['auth:sanctum']], function () {
// });
Route::get('/test', function () {
    p("working");
   });

// Route::post('/v1/register', [RegistrationController::class, 'register'])->name('register');
// Route::post('/v1/login', [LoginController::class, 'login'])->name('login');

// Route::prefix('superuser')->name('superuser.')->middleware(['auth', 'role:superuser'])->group(function () {
// Route::get('/v1/get-users', [SuperuserController::class, 'getUsers'])->name('get-users');
// Route::post('/v1/update-user/{id}', [SuperuserController::class, 'updateUser'])->name('update-users');
// Route::get('/v1/get-wallets', [SuperuserController::class, 'getWallets'])->name('get-wallets');
// Route::post('/v1/create-store', [SuperuserController::class, 'createStore'])->name('create-store');
// Route::post('/v1/update-store/{id}', [SuperuserController::class, 'updateStores'])->name('update-store');
// Route::delete('/v1/delete-store/{id}', [SuperuserController::class, 'deleteStores'])->name('delete-store');
// Route::get('/v1/get-stores', [SuperuserController::class, 'getStores'])->name('get-stores');
// Route::post('/v1/create-cashier', [SuperuserController::class, 'createCashier'])->name('create-cashier');
// Route::post('/v1/update-cashier/{id}', [SuperuserController::class, 'updateCashier'])->name('update-cashier');
// Route::delete('/delete-cashier/{id}', [SuperuserController::class, 'deleteCashier'])->name('delete-cashier');
// Route::get('/v1/get-cashiers', [SuperuserController::class, 'index'])->name('get-cashiers');
// Route::get('/v1/get-payments', [SuperuserController::class, 'getPaymentlist'])->name('get-payment');
// Route::get('/v1/get-invoices', [SuperuserController::class, 'getInvoices'])->name('get-invoices');
// });
// Route::get('/get-payments', [CashierController::class, 'getPayments'])->name('customer');
// Route::prefix('cashier')->name('cashier.')->middleware(['auth', 'role:cashier'])->group(function () {
// Route::post('/v1/create-payment', [CashierController::class, 'createPayment'])->name('create-payment');
// Route::post('/v1/update-payment/{id}', [CashierController::class, 'updatePayment'])->name('update-payment');
// Route::post('/v1/create-invoice', [CashierController::class, 'createInvoice'])->name('create-invoice');
// Route::post('/v1/update-invoice/{id}', [CashierController::class, 'updateInvoice'])->name('update-invoice');
// });
// Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
//     Route::get('/v1/get-wallets', [CustomerController::class, 'getWallets'])->name('get-wallets');
//     Route::get('/v1/get-payments', [CustomerController::class, 'getPayments'])->name('get-payments');
// });
