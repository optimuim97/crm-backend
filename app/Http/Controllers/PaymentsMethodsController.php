<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Symfony\Component\HttpFoundation\Response;

class PaymentsMethodsController extends Controller
{
    public function getAll(){
        $paymentsMethods = PaymentMethod::orderBy('created_at', 'DESC')->get();

        return respJson(
            Response::HTTP_OK,
            "All",
            $paymentsMethods
        );

    }
}
