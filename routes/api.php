<?php

use App\Http\Controllers\CreatePurchaseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Providers\ProviderController;
use App\Http\Controllers\PurchaseOrders\ValidedPurchaseOrderController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\UpdateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ["auth:api"]], function () {
    Route::post('/logout', LogoutController::class)->name('logout.api');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/sign-in', LoginController::class)->name('login.api');
Route::post('/register', RegisterController::class)->name('register.api');

Route::get('/login', function () {
    return response('Utilisateur doit s\'authentifier');
})->name('login');

// Product
Route::post('add-product', [ProductController::class, 'add']);
Route::get('products', [ProductController::class, 'all']);
Route::get('show-product/{ref}', [ProductController::class, 'show']);
Route::patch('update-product/{ref}', [ProductController::class, 'update']);
Route::delete('delete-product', [ProductController::class, 'delete']);

Route::get('update-stock/{orderNumber}', UpdateProductController::class);

//Providers
Route::post('add-provider', [ProviderController::class, 'add']);
Route::get('providers', [ProviderController::class, 'all']);
Route::get('show-provider/{ref}', [ProviderController::class, 'show']);
Route::patch('update-provider/{ref}', [ProviderController::class, 'update']);
Route::delete('delete-provider', [ProviderController::class, 'delete']);

// Achat
Route::post('create-purchase-order', CreatePurchaseController::class);
Route::patch('update-purchase-order/{order_number}', ValidedPurchaseOrderController::class);

// Vente
Route::post('create-quotation', [QuotationController::class, 'add']);
Route::post('confirm-quotation', [QuotationController::class, 'confirme']);

//Providers
// Route::post('add-provider', [ProviderController::class, 'add']);
// Route::get('providers', [ProviderController::class, 'all']);
// Route::get('show-provider/{ref}', [ProviderController::class, 'show']);
// Route::patch('update-provider/{ref}', [ProviderController::class, 'update']);
// Route::delete('delete-provider', [ProviderController::class, 'delete']);
