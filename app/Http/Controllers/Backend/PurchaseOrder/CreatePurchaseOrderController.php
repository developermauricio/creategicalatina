<?php

namespace App\Http\Controllers\Backend\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Mail\purchaseOrder\NewPurchaseOrderCustomer;
use App\Model\PurchaseOrder;
use App\Models\ItemsPurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreatePurchaseOrderController extends Controller
{
    public function index(){
        return view('backend.pages.purchase-order.new-purchase-order');
    }

    public function storeCreatePurchaseOrder(Request $request){

        $ramdon = Str::random(25);


        $project = json_decode($request->project);
        $customer = json_decode($request->customer);
        $company = json_decode($request->company);
        $languageEmail = json_decode($request->languageEmail);
        $user = auth()->user()->id;
        $purchaseCode = $request->code;
        $subtotal = $request->subtotal;
        $total = $request->total;
        $dateExpiration = $request->date_expiration;
        $items = json_decode($request->items);
        $observation = $request->observation;
        $sendEmail = $request->sendEmail;
        $sendEmailManager = $request->sendEmailManager;


        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->project_id = $project->id;
        $purchaseOrder->customer_id = $customer->id;
        if ($company !== null){
            $purchaseOrder->company_id = $company->id;
        }
        $purchaseOrder->user_id = $user;
        $purchaseOrder->code = $purchaseCode;
        $purchaseOrder->note = $observation;
        $purchaseOrder->subtotal = $subtotal;
        $purchaseOrder->total = $total;
        $purchaseOrder->iva = 19;
        $purchaseOrder->slug = Str::slug($purchaseCode .'-'. $ramdon, '-');
        $purchaseOrder->expiration = $dateExpiration;

        if ($sendEmail === "1"){
            $purchaseOrder->state = 1;
        }else{
            $purchaseOrder->state = 2;
        }

        $purchaseOrder->save();

        foreach ($items as $item){
            $purchaseOrderItem = new ItemsPurchaseOrder;
            $purchaseOrderItem->purchase_order_id = $purchaseOrder->id;
            $purchaseOrderItem->item = $item->value->item;
            $purchaseOrderItem->price = $item->value->price;
            $purchaseOrderItem->quantity = $item->value->quantity;
            $purchaseOrderItem->value_final = $item->value->price * (int)$item->value->quantity;

            $purchaseOrderItem->save();
        }

        if ($sendEmail === "1" && $company !== null){

            Mail::to($company->email)->locale($languageEmail->code)->send(
                new NewPurchaseOrderCustomer(
                    $company->name,
                    '',
                    $purchaseOrder->code,
                    $project->name,
                    $purchaseOrder->slug

                ));
        }

        if ($sendEmailManager === "true" && $sendEmail === "1" && $company !== null){
            Mail::to($customer->user->email)->locale($languageEmail->code)->send(
                new NewPurchaseOrderCustomer(
                    $customer->user->name,
                    $customer->user->last_name,
                    $purchaseOrder->code,
                    $project->name,
                    $purchaseOrder->slug

                ));
        }



        if ($sendEmailManager === "false" && $sendEmail === "1" && $company === null){

            Mail::to($customer->user->email)->locale($languageEmail->code)->send(
                new NewPurchaseOrderCustomer(
                    $customer->user->name,
                    $customer->user->last_name,
                    $purchaseOrder->code,
                    $project->name,
                    $purchaseOrder->slug

                ));
        }


        return response()->json('Registro Exitoso');
    }
}
