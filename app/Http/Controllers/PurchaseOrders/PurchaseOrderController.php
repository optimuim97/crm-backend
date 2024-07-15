<?php

namespace App\Http\Controllers\PurchaseOrders;

use App\Http\Controllers\Controller;
use App\Services\PurchaseOrderService;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{

    public function __construct(private PurchaseOrderService $purchaseOrderService)
    {
    }

    public function all()
    {
        return $this->purchaseOrderService->all();
    }

    public function show($ref)
    {
        return $this->purchaseOrderService->show($ref);
    }

    public function update($ref, Request $request)
    {
        $input = $request->all();
        return $this->purchaseOrderService->update($ref, $input);
    }

    public function delete($ref)
    {
        return $this->purchaseOrderService->delete($ref);
    }
}
