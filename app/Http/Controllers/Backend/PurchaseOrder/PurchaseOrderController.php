<?php

namespace App\Http\Controllers\Backend\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\PaymentController;
use App\Mail\purchaseOrder\SendEmailPurchaseOrder;
use App\Model\HistorialPurchaseOrder;
use App\Model\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('backend.pages.purchase-order.list-purchase-orders');
    }

    public function getDatableProvider(Request $request)
    {
        $purchaseOrder = PurchaseOrder::with('project', 'customer.user', 'company')->orderby('id', 'desc');

        $fecha_registro_min = $request->input('fecha_registro_min');
        if ($fecha_registro_min){
            $purchaseOrder->whereDate('created_at', '>=', $fecha_registro_min);
        }

        $fecha_registro_max = $request->input('fecha_registro_max');
        if ($fecha_registro_max){
            $purchaseOrder->whereDate('created_at', '<=', $fecha_registro_max);
        }

        return datatables()->of($purchaseOrder->get())->toJson();
    }

    public function indexPurchaseOrderPayment(string $locale, PurchaseOrder $purchaseOrder)
    {
        $dataPurchase = PurchaseOrder::where('id', $purchaseOrder->id)->with('purchaseItems', 'user', 'customer.user.city.country', 'customer.user.country', 'project.typeProject', 'project.project_categories', 'company.country', 'company.city')->first();

        $dataPayu = PaymentController::getConfigPayu($dataPurchase->id, $dataPurchase->note,
            $dataPurchase->total, $dataPurchase->iva, $dataPurchase->customer->user->email, $dataPurchase->customer->user->country->alpha2Code
        );

        $dataMercadoPago = PaymentController::getConfigMercadoPago(
            $dataPurchase->id, $dataPurchase->total, $dataPurchase->customer->user->email,
            $dataPurchase->customer->user->country->alpha2Code, $dataPurchase->project->name, $dataPurchase->note
        );

        return view('backend.pages.purchase-order.purchase-send-payment-customer', compact('dataPurchase', 'dataPayu', 'dataMercadoPago'));
    }

    public function getDataPurchase($id)
    {
        $dataPurchase = PurchaseOrder::where('id', $id)->with('purchaseItems', 'user', 'customer.user.city.country', 'customer.user.country', 'project.typeProject', 'project.project_categories', 'company.country', 'company.city', 'history')->first();
        return response()->json(['data' => $dataPurchase]);
    }

    public function sendEmailPurchaseOrder(Request $request)
    {
        $emails = json_decode($request->emails);
        $message = $request->message;
        $subject = $request->subject;
        $project = $request->project;
        $code = $request->code;
        $slug = $request->slug;
        $name = '';
        $idPurchase = $request->idPurchase;
        $expiration = $request->expiration;

        foreach ($emails as $item) {
            if (isset($item->name)){
                $name = $item->name;
            }else{
                $name = '';
            }
            Mail::to($item->email)->send(
                new SendEmailPurchaseOrder(
                    $name,
                    $code,
                    $project,
                    $slug,
                    $expiration,
                    $subject,
                    $message
                ));
        }

        $emailsArray = [];
        foreach ($emails as $email){
            array_push($emailsArray, $email->email);
        }

        $historyPurchase = new HistorialPurchaseOrder;
        $historyPurchase->id_purchase = $idPurchase;
        $historyPurchase->title = 'Se envio la orden de pago por correo electrónico a:';
        $historyPurchase->description = implode(', ', $emailsArray);
        $historyPurchase->class_color = 'info';
        $historyPurchase->save();
    }
}
