<?php

namespace App\Http\Controllers\Backend\Invoice;

use App\Http\Controllers\Controller;
use App\Model\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function indexPrint(string $locale, Invoice $invoice){
//        dd($invoice);
        return view('backend.pages.invoice.invoice-print', compact('invoice'));
    }
}
