<?php

namespace App\Http\Controllers\Quotations;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class QuotationController extends Controller
{
    public function confirme($quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);

        foreach ($quotation->products as $product) {
            // $product->quantite_stock -= $product->pivot->quantity;
            $product->quantity -= $product->pivot->quantity;
            $product->save();
        }

        return respJson(Response::HTTP_CREATED, "Devis confirmée et stock mis à jour", $quotation);
    }
}
