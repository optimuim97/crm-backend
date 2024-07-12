<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CreatePurchaseController extends Controller
{
    public function __invoke(Request $request)
    {

        try {

            $data = $request->all();
            // First validate the form data
            $validatedData = customValidation($data, PurchaseOrder::$rules);

            $purchaseOrder = PurchaseOrder::create([
                // 'order_number' => $validatedData['order_number'],
                'provider_reference' => $validatedData['provider_reference'],
                'total_amount' => $validatedData['total_amount'],
            ]);

            foreach ($validatedData['products'] as $productData) {
                $product = Product::find($productData['id']);
                $purchaseOrder->products()->attach($product->id, ['quantity' => $productData['quantity']]);
            }

            return respJson(Response::HTTP_CREATED, "Created", $purchaseOrder);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return response()->json($errors);
        }
    }
}
