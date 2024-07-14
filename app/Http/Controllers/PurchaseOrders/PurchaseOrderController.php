<?php

namespace App\Http\Controllers\PurchaseOrders;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PurchaseOrder;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class PurchaseOrderController extends Controller
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

        //TODO add invoice
        $data = [
            "purchase_order_id" => $order->id,
            "provider_id" => $order->provider_id,
            "total_amount" => "",
            "is_valided" => ""
        ];

        try {

            $validData = customValidation($data, Invoice::$rules);
            $invoice = Invoice::create();

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json($errors);
        }

        //TODO add save transactions
        return respJson(Response::HTTP_OK, "Updated", $order);
    }
}
