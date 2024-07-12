<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class QuotationController extends Controller
{
    public function add(Request $request)
    {
        try {

            $validatedData = customValidation($request->all(), Quotation::$rules);
            $quotation = Quotation::create();

            foreach ($validatedData['products'] as $productData) {
                $product = Product::find($productData['id']);
                $quotation->products()->attach($product, ['quantity' => $productData['quantity']]);
            }

            return respJson(Response::HTTP_CREATED, "Created", $quotation);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return response()->json($errors);
        }
    }
    public function confirme($quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);

        foreach ($quotation->products as $product) {
            $product->quantite_stock -= $product->pivot->quantity;
            $product->save();
        }

        return response()->json(['message' => 'Quotation confirmée et stock mis à jour']);
    }
}
