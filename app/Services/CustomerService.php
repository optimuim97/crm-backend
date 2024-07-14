<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CustomerService
{

    public function add($input)
    {
        try {

            $data = customValidation($input, Customer::$rules);
            $product = Customer::create($data);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return response()->json($errors);
        }

        return respJson(Response::HTTP_CREATED, "Created", $product);
    }

    public function show($ref)
    {
        $product = Customer::where('internal_reference', $ref)->first();

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
        $product = Customer::where('internal_reference', $ref)->first();

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
        $product = Customer::where(['internal_reference' => $ref])->first();

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
        $products = Customer::orderBy('created_at', 'DESC')->get();

        return respJson(
            Response::HTTP_OK,
            "All",
            $products
        );
    }
}
