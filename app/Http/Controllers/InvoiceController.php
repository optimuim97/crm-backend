<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProductResource;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;

class InvoiceController extends Controller
{
    public function show($invoiceNumber)
    {
        $invoice = Invoice::where("invoice_number", $invoiceNumber)->first();
        if (empty($invoice)) {
            return notFound('Facture Introuvable');
        }

        $products = $invoice->purchaseOrder->products;
        return respJson(
            Response::HTTP_OK,
            "Information de Commande et produits",
            [
                'invoice' => $invoice,
                'products' => ProductResource::collection($products)
            ]
        );
    }

    public function showInvoice($orderNumber)
    {
        $purchaseOrder = PurchaseOrder::where('order_number', $orderNumber)->first();

        if ($purchaseOrder->is_valided != true) {
            return badReq();
        }

        if (empty($purchaseOrder)) {
            return notFound('Facture Introuvable');
        }

        $products = $purchaseOrder->products;

        return respJson(
            Response::HTTP_OK,
            "Information de Commande et produits",
            [
                'purchaseOrder' => new PurchaseOrderResource($purchaseOrder),
                'products' => ProductResource::collection($products)
            ]
        );
    }
}
