<?php

namespace App\Http\Controllers;

use App\Models\InvoiceCustomer;
use App\Models\TransactionCustomer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CreateCustomerTransactionController extends Controller
{

    public function __invoke(Request $request, $invoiceNumber)
    {

        try {

            $invoice = InvoiceCustomer::where(['invoice_number' => $invoiceNumber])->first();

            if (!empty($invoice)) {
                if ($invoice->is_paid == true) {
                    return badReq('Facture déja payé');
                }
            }

            $data = $request->all();
            $data['invoice_customer_id'] = $invoice->id;
            $data['payment_method_id'] = $data['payment_method']['id'];
            $data['amount'] = $invoice->total_amount;
            $data['total_amount'] = $invoice->amount + $invoice->fee;
            $data['fee'] = $invoice->fee;
            $data['status'] = true;
            $data['memo'] = "Paiement de la facture $invoiceNumber";

            $validateData = customValidation($data, TransactionCustomer::$rules);

            $transaction  = TransactionCustomer::create($validateData);
            $invoice->is_paid = true;
            $invoice->save();

            return respJson(Response::HTTP_OK, "Updated", $transaction);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            return response()->json($errors, 422);
        }
    }
}
