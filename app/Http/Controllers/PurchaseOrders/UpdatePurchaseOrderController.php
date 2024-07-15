<?php

namespace App\Http\Controllers\PurchaseOrders;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\Transaction;
use App\Services\PurchaseOrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UpdatePurchaseOrderController extends Controller
{
    public function __invoke($orderNumber)
    {

        $order = PurchaseOrder::where(["order_number" => $orderNumber])->first();
        if (empty($order)) {
            return notFound();
        }

        if ($order->is_validate == true) {
            return respJson(302, "Déjà validé", []);
        }

        $order->is_valided = true;
        $order->save();

        try {

            //TODO add invoice
            $fee = 0;
            $data = [
                "purchase_order_id" => $order->id,
                "provider_id" => $order->provider_id,
                'fee' => $fee,
                'amount' => $order->total_amount,
                "total_amount" => $order->total_amount + $fee
            ];

            $validData = customValidation($data, Invoice::$rules);
            $invoice = Invoice::create($validData);

            return respJson(Response::HTTP_OK, "Updated", ["order" => $order, "invoice" => $invoice]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json($errors);
        }
    }
}
