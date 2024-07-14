<?php

namespace App\Http\Controllers\Quotations;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CreateQuotationController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $validatedData = customValidation($request->all(), Quotation::$rules);
            $quotation = Quotation::create($validatedData);

            foreach ($validatedData['products'] as $productData) {
                $product = Product::find($productData['id']);

                if ($product->quantity > 0) {
                    $quotation->products()->attach($product, ['quantity' => $productData['quantity']]);
                } else {
                    return respJson(Response::HTTP_FORBIDDEN, "Le produit, n'est plus disponible en stock", $product);
                }
            }

            return respJson(Response::HTTP_CREATED, "Created", $quotation);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return response()->json($errors, 422);
        }
    }
}
