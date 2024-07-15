<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class CreateTransactionController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $data = $request->all();
            $validateData = customValidation($data, Transaction::$rules);
            $transaction  = Transaction::create($validateData);

            return respJson(Response::HTTP_OK, "Updated", $transaction);

        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return response()->json($errors, 422);
        }
    }
}
