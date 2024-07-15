<?php

use App\Http\Controllers\CreateTransactionController;
use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaymentsMethodsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Providers\ProviderController;
use App\Http\Controllers\PurchaseOrders\CreatePurchaseController;
use App\Http\Controllers\PurchaseOrders\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrders\UpdatePurchaseOrderController;
use App\Http\Controllers\Quotations\CreateQuotationController;
use App\Http\Controllers\Quotations\QuotationController;
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

// PurchaseOrder
Route::get('purchase-orders', [PurchaseOrderController::class, 'all']);
Route::get('show-purchase-orders/{ref}', [PurchaseOrderController::class, 'show']);
Route::patch('update-purchase-orders/{ref}', [PurchaseOrderController::class, 'update']);
Route::delete('delete-purchase-orders', [PurchaseOrderController::class, 'delete']);

//Providers
Route::post('add-provider', [ProviderController::class, 'add']);
Route::get('providers', [ProviderController::class, 'all']);
Route::get('show-provider/{ref}', [ProviderController::class, 'show']);
Route::patch('update-provider/{ref}', [ProviderController::class, 'update']);
Route::delete('delete-provider', [ProviderController::class, 'delete']);

//Customers
Route::post('add-customer', [CustomerController::class, 'add']);
Route::get('customers', [CustomerController::class, 'all']);
Route::get('show-customer/{ref}', [CustomerController::class, 'show']);
Route::patch('update-customer/{ref}', [CustomerController::class, 'update']);
Route::delete('delete-customer', [CustomerController::class, 'delete']);

// PurchaseOrder
Route::post('create-purchase-order', CreatePurchaseController::class);
Route::patch('update-purchase-order/{orderNumber}', UpdatePurchaseOrderController::class);
Route::get('update-stock/{orderNumber}', UpdateProductController::class);

// Quotation
Route::post('create-quotation', CreateQuotationController::class);
Route::post('confirm-quotation', [QuotationController::class, 'confirme']);

//Payments
Route::post('create-transaction', CreateTransactionController::class);
Route::get('get-payments-methods', [PaymentsMethodsController::class, 'getAll']);

Route::get('get-invoice/{invoiceNumber}', [InvoiceController::class, 'show']);
