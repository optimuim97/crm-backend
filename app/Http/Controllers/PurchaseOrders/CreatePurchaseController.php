<?php

namespace App\Http\Controllers\PurchaseOrders;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Provider;
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
            $provider = Provider::where(['reference' => $validatedData['provider_reference']])->first();

            if (empty($provider)) {
                return notFound("Fournisseur Introuvable");
            }

            $purchaseOrder = PurchaseOrder::create([
                'provider_reference' => $validatedData['provider_reference'],
                'provider_id' => $provider->id,
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
