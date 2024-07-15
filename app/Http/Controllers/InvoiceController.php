<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($invoiceNumber)
    {
        $invoice = Invoice::where("invoice_number", $invoiceNumber)->first();
        $pdf = Pdf::loadView('pdf.invoice',["invoice"=>$invoice->toArray()]);
        return $pdf->download('invoice.pdf');
    }
}
