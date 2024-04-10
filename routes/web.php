<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Store\StoreOwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperuserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  [LoginController::class, 'getLoginpage']);
Route::get('/login', [LoginController::class, 'getLoginpage'])->name('login');
Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password', [LoginController::class, 'get_reset_password'])->name('reset-password');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::post('/send-reset-link', [LoginController::class, 'sendLink'])->name('send-reset-link');
Route::post('/loginSubmit', [LoginController::class, 'loginSubmit'])->name('loginSubmit');

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/dashboard', [StoreOwnerController::class, 'dashboard'])->name('dashboard');
    Route::get('/add-transactions', [StoreOwnerController::class, 'get_add_client'])->name('add-transactions');
    Route::post('/add-transaction', [StoreOwnerController::class, 'add_transaction'])->name('add-transaction');
    Route::get('/clients', [StoreOwnerController::class, 'get_clients'])->name('clients');
    Route::get('/single-client/{id}', [StoreOwnerController::class, 'get_single_client'])->name('single-client');
    Route::get('/edit-client/{id}', [StoreOwnerController::class, 'get_edit_client'])->name('edit-client');
    Route::post('/edit-client', [StoreOwnerController::class, 'edit_client'])->name('edit-client');
    Route::get('/disable-client/{id}', [StoreOwnerController::class, 'disable_client'])->name('disable-client');
    Route::get('extend-subscription/{id}', [StoreOwnerController::class, 'extend_subscription'])->name('extend-subscription');
    Route::get('/transactions', [StoreOwnerController::class, 'get_transactions'])->name('transactions');
    Route::get('/delete-transaction/{id}', [StoreOwnerController::class, 'delete_transaction'])->name('delete-transactions');
    Route::get('/generate-receipt/{id}', [UserController::class, 'get_receipt'])->name('generate-receipt');
    Route::get('/download-tranx/{id}', [StoreOwnerController::class, 'download_tx'])->name('download-tranx');
    Route::get('/download-tranxs', [StoreOwnerController::class, 'download_txs'])->name('download-tranxs');
    // Route::get('/getBusdBal', [StoreOwnerController::class, 'getBusdBal'])->name('getBusdBal');
    // Route::get('/getSolanaBal', [StoreOwnerController::class, 'getSolanaBal'])->name('getSolanaBal');
    // Route::get('/getTetherBal', [StoreOwnerController::class, 'getTetherBal'])->name('getTetherBal');
    // Route::get('/getTotalBalance', [StoreOwnerController::class, 'getTotalBalance'])->name('getTotalBalance');
    // Route::post('/records-filter', [StoreOwnerController::class, 'getFilteredRecords'])->name('records-filter');
    // Route::get('/cashier-dashboard', [StoreOwnerController::class, 'getCashierDashboard'])->name('cashier-dashboard');
    // Route::get('/create-cashier', [StoreOwnerController::class, 'createCashier'])->name('create-cashier');
    // Route::post('/store-cashier', [StoreOwnerController::class, 'storeCashier'])->name('store-cashier');
    Route::get('/edit-cashier/{id}', [StoreOwnerController::class, 'editCashier'])->name('edit-cashier');
    // Route::post('/update-cashier', [StoreOwnerController::class, 'updateCashier'])->name('update-cashier');
    Route::get('/delete-cashier/{id}', [StoreOwnerController::class, 'deleteCashier'])->name('delete-cashier');
    Route::post('/delete-confirm', [StoreOwnerController::class, 'deleteCashierConfirm'])->name('delete-confirm');
    Route::get('/get-profile/{id}', [StoreOwnerController::class, 'getProfile'])->name('get-profile');
    Route::post('/update-profile', [StoreOwnerController::class, 'updateProfile'])->name('update-profile');
    Route::post('/update-password', [StoreOwnerController::class, 'updatePassword'])->name('update-password');
    // Route::post('/add-store-wallets', [StoreOwnerController::class, 'addStoreWallets'])->name('add-store-wallets');
    // Route::post('/withdraw', [StoreOwnerController::class, 'withdrawFunds'])->name('withdraw');
    // Route::get('/settings', [StoreOwnerController::class, 'get_settings'])->name('settings');
   Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/settings', [StoreOwnerController::class, 'get_settings'])->name('settings');
     Route::post('/update-password', [StoreOwnerController::class, 'updatePassword'])->name('update-password');
    Route::post('/update', [StoreOwnerController::class, 'updateProfile'])->name('update-company');
});
// Route::middleware(['role:superuser'])->group(function () {
//     //  Route::post('/dashboard', [UserController::class, 'post_login'])->name('login');
//     Route::get('/add', [UserController::class, 'get_add_company'])->name('dashboard');
//     Route::get('/companies', [UserController::class, 'get_companies'])->name('companies');
//     Route::get('/single-company/{id}', [UserController::class, 'get_single_company'])->name('single-company');
//     Route::get('/edit-company/{id}', [UserController::class, 'get_edit_company'])->name('edit-company');
//     Route::post('/edit-company', [UserController::class, 'edit_company'])->name('edit-company');
//     Route::get('/disable-company/{id}', [UserController::class, 'disable_company'])->name('disable-company');
//     Route::post('/add-company', [UserController::class, 'add_company'])->name('add-company');
//     Route::get('/clients/{id}', [UserController::class, 'get_clients'])->name('clients');
//     Route::get('/edit-client/{id}', [UserController::class, 'get_edit_client'])->name('edit-client');
//     Route::get('/generate-receipt/{id}', [UserController::class, 'get_receipt'])->name('generate-receipt');
//     Route::post('/edit-client', [UserController::class, 'edit_client'])->name('edit-client');
//     Route::get('/settings', [UserController::class, 'get_settings'])->name('settings');
//     Route::get('/dashboard', [UserController::class, 'get_dashboard'])->name('dashboard');
//     Route::get('/disable-client/{id}', [StoreOwnerController::class, 'disable_client'])->name('disable-client');
//     Route::get('extend-subscription/{id}', [StoreOwnerController::class, 'extend_subscription'])->name('extend-subscription');
//     Route::get('/transactions', [UserController::class, 'get_transactions'])->name('transactions');

//     // Route::get('/cashiers', [UserController::class, 'get_cashiers'])->name('cashiers');
//     // Route::get('/stores', [UserController::class, 'get_stores'])->name('stores');
//     // Route::post('/add-store', [UserController::class, 'add_store'])->name('add-store');
//     // Route::post('/add-cashier', [UserController::class, 'add_cashier'])->name('add-cashier');
//     Route::get('/single-transaction/{id}', [UserController::class, 'get_single_transaction'])->name('single-transaction');
//     Route::get('/edit-store/{id}', [UserController::class, 'get_edit_store'])->name('edit-store');
//     Route::post('/edit-store', [UserController::class, 'edit_store'])->name('edit-store');
//     Route::get('/delete-store/{id}', [UserController::class, 'delete_store'])->name('delete-store');
//     Route::get('/edit-cashier/{id}', [UserController::class, 'get_edit_cashier'])->name('edit-cashier');
//     Route::post('/edit-cashier', [UserController::class, 'edit_cashier'])->name('edit-cashier');
//     Route::get('/delete-cashier/{id}', [UserController::class, 'delete_cashier'])->name('delete-cashier');
//     Route::get('/single-store/{id}', [UserController::class, 'get_single_store'])->name('single-store');
//     Route::get('/single-client/{id}', [UserController::class, 'get_single_client'])->name('single-client');
//     // Route::get('/get-usdt-balance', [UserController::class, 'refresh_usdt'])->name('getBal');
//     Route::get('/logout', [UserController::class, 'logout'])->name('logout');
//     // Route::get('/test-wallet', [UserController::class, 'test_wallet'])->name('wallet');
//     // Route::post('/add-wallets', [UserController::class, 'addAdminWallets'])->name('add-wallets');
//     Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
//     Route::post('/update-admin', [UserController::class, 'updateProfile'])->name('update-admin');
// });
