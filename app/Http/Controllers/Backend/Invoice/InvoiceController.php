<?php

namespace App\Http\Controllers\Backend\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\PaymentController;
use App\Mail\Invoice\NewInvoiceCustomer;
use App\Model\Invoice;
use App\Model\InvoiceItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function indexPrint(string $locale, Invoice $invoice){
        $invoice = Invoice::where('id', $invoice->id)->with('invoiceItems', 'user', 'customer.user.city.country',  'customer.user.country')->first();
        return view('backend.pages.invoice.invoice-print', compact('invoice'));
    }

    public function indexInvoicePayment(string $locale, Invoice $invoice){


        $dataInvoice = Invoice::where('id', $invoice->id)->with('invoiceItems', 'user', 'customer.user.city.country',  'customer.user.country')->first();

        return view('backend.pages.invoice.invoice-send-payment-customer', compact('dataInvoice'));
    }

    public function storeCreateInvoice(Request $request){

        $ramdon = Str::random(50);

        $project = json_decode($request->project);
        $customer = json_decode($request->customer);
        $company = json_decode($request->company);
        $user = auth()->user()->id;
        $invoiceNumber = $request->code;
        $subtotal = $request->subtotal;
        $total = $request->total;
        $date = $request->date_issue;
        $dateExperation = $request->date_expiration;
        $items = json_decode($request->items);
        $observation = $request->observation;
        $sendEmail = $request->sendEmail;

        $invoice = new Invoice;
        $invoice->project_id = $project->id;
        $invoice->customer_id = $customer->id;
        $invoice->company_id = $company->id;
        $invoice->user_id = $user;
        $invoice->code = $invoiceNumber;
        $invoice->note = $observation;
        $invoice->subtotal = $subtotal;
        $invoice->total = $total;
        $invoice->iva = 19;
        $invoice->slug = Str::slug($invoiceNumber .'-'. $ramdon, '-');
        $invoice->date = $date;
        $invoice->expiration = $dateExperation;

        $invoice->save();

        foreach ($items as $item){
            $invoiceItem = new InvoiceItems;
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->item = $item->value->item;
            $invoiceItem->price = $item->value->price;
            $invoiceItem->quantity = $item->value->quantity;
            $invoiceItem->value_final = $item->value->price * (int)$item->value->quantity;

            $invoiceItem->save();
        }

        if ($sendEmail === "1"){
            Mail::to($customer->user->email)->locale(session('language'))->send(
                new NewInvoiceCustomer(
                    $customer->user->name,
                    $customer->user->last_name,
                    $invoice->code,
                    $project->name,
                    $invoice->slug

                ));
        }

        return response()->json('El registro se realizó correctamente');

    }
}
