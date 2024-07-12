<?php

namespace App\Http\Controllers\PurchaseOrders;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidedPurchaseOrderController extends Controller
{
    public function __invoke($orderNumber)
    {

        $order = PurchaseOrder::where(["order_number" => $orderNumber])->first();

        if (empty($order)) {
            return notFound();
        }

        $order->is_valided = true;
        $order->save();

        return respJson(Response::HTTP_OK, "Updated", $order);
    }
}
