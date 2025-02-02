<?php

namespace App\Services;

use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class PurchaseOrderService
{

    public function add($input)
    {
        try {

            $data = customValidation($input, PurchaseOrder::$rules);
            $product = PurchaseOrder::create($data);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return badData(errors:$errors);;
        }

        return respJson(Response::HTTP_CREATED, "Created", $product);
    }

    public function show($ref)
    {
        $product = PurchaseOrder::where('internal_reference', $ref)->first();

        if (empty($product)) {
            return notFound();
        }

        return respJson(
            Response::HTTP_OK,
            "Details",
            $product
        );
    }

    public function update($ref, $input)
    {
        $product = PurchaseOrder::where('internal_reference', $ref)->first();

        if (empty($product)) {
            return notFound();
        }

        $product->update($input);

        return respJson(
            Response::HTTP_OK,
            "Update",
            $product
        );
    }

    public function delete($ref)
    {
        $product = PurchaseOrder::where(['internal_reference' => $ref])->first();

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
        $purchaseOrder = PurchaseOrder::orderBy('created_at', 'DESC')->get();

        return respJson(
            Response::HTTP_OK,
            "All",
            // $purchaseOrder
            PurchaseOrderResource::collection($purchaseOrder)
        );
    }
}
