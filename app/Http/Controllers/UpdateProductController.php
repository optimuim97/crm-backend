<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductController extends Controller
{
    public function __invoke($orderNumber)
    {
        $purchase = PurchaseOrder::where(["order_number" => $orderNumber])->first();
        if (empty($purchase)) {
            return notFound();
        }

        $products = [];
        if ($purchase->is_valided == true) {
            foreach ($purchase->products as $key => $value) {

                $product = Product::find($value->pivot->product_id);
                $product->quantity_stock = $value->pivot->quantity;
                $product->save();

                array_push($products, $product);
            }
        }

        return respJson(Response::HTTP_OK, "Updated", $products);
    }
}
