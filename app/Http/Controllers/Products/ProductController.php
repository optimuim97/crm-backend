<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService)
    {
    }

    public function add(Request $request)
    {
        return $this->productService->add($request->all());
    }

    public function all()
    {
        return $this->productService->all();
    }

    public function show($ref)
    {
        return $this->productService->show($ref);
    }

    public function update($ref, Request $request)
    {
        $input = $request->all();
        return $this->productService->update($ref, $input);
    }

    public function delete(Product $product)
    {
        return $this->productService->delete($product->internal_reference);
    }
}
