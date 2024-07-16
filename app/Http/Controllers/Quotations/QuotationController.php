<?php

namespace App\Http\Controllers\Quotations;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;
use App\Models\InvoiceCustomer;
use App\Models\Quotation;
use Symfony\Component\HttpFoundation\Response;

class QuotationController extends Controller
{

    public function show($quoteNumber)
    {
        $quotation = Quotation::where('quote_number', $quoteNumber)->first();

        if (empty($quotation)) {
            return notFound();
        }

        return respJson(
            Response::HTTP_OK,
            "Details",
            $quotation
        );
    }

    public function update($quoteNumber, $input)
    {
        $quotation = Quotation::where('quote_number', $quoteNumber)->first();

        if (empty($quotation)) {
            return notFound();
        }

        $quotation->update($input);

        return respJson(
            Response::HTTP_OK,
            "Update",
            $quotation
        );
    }

    public function delete($ref)
    {
        $product = Quotation::where(['quote_number' => $ref])->first();

        if (empty($product)) {
            return notFound();
        }

        $product->delete();

        return respJson(
            Response::HTTP_NO_CONTENT,
            "Deleted",
            $product
        );
    }

    public function all()
    {
        $quotation = Quotation::orderBy('created_at', 'DESC')->get();

        return respJson(
            Response::HTTP_OK,
            "All",
            // $purchaseOrder
            QuotationResource::collection(
                $quotation
            )
        );
    }

    public function confirme($quoteNumber)
    {
        $quotation = Quotation::where('quote_number', $quoteNumber)->firstOrFail();

        foreach ($quotation->products as $product) {

            if ($product->pivot->quantity > $product->quantity_stock) {
                return badReq('Quantité indisponible en stock');
            }

            $product->quantity_stock -= $product->pivot->quantity;
            $product->save();
        }

        $quotation->confirmed = true;

        //TODO add invoice
        $fee = 0;
        $data = [
            "quotation_id" => $quotation->id,
            "customer_id" => $quotation->customer_id,
            'fee' => $fee,
            'amount' => $quotation->total_amount,
            "total_amount" => $quotation->total_amount + $fee
        ];

        $validData = customValidation($data, InvoiceCustomer::$rules);
        $invoice = InvoiceCustomer::create($validData);

        $quotation->save();

        return respJson(
            Response::HTTP_OK,
            "Devis confirmée et stock mis à jour",
            [
                'quotation' => $quotation,
                'invoice' => $invoice
            ]
        );
    }
}
