<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Model\paymentPlatform;
use App\Resolvers\PaymentPlatformResolver;
use Gjae\MercadoPago\MercadoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver) {
//        $this->middleware('auth');
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    // TODO: realizar el pago
    public function pay( Request $request ) {
        //dd('llego a Pay...', $request);
        $rules = [
            'value' => ['required', 'numeric', 'min:3'],
            'currency' => ['required', 'exists:currencies,iso'],
            'payment_platform' => ['required', 'exists:payment_platforms,id']
        ];

        $request->validate($rules);

        $paymentPlatform = $this->paymentPlatformResolver->resolveService( $request->payment_platform );

        session()->put('paymentPlatformId', $request->payment_platform);

        return $paymentPlatform->handlePayment($request);
    }

    public function approval() {
        if ( session()->has('paymentPlatformId') ) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService( session()->get('paymentPlatformId') );

            return $paymentPlatform->handleApproval();
        }

        $msg = __('email.no_approval_platform_payment');

        return response()->json( [ 'status' => 'failed', 'msg' => $msg] );
    }

    public function cancelled() {
        $msg = __('email.cancel_payment');

        return response()->json( [ 'status' => 'cancelled', 'msg' => $msg ] );
    }

    public function getMethodsPayment(){
       $payments =  paymentPlatform::all();

       return response()->json(['data' => $payments]);
    }

    static public function getConfigPayu($invoiceId, $invoiceDescription,
                                         $invoiceTotal, $invoiceIva, $customerEmail, $countryCode
    ){
        $apiKey = env('PAYU_API_KEY');
        $marchantId = env('PAYU_MARCHANT_ID');
        $accountId = env('PAYU_ACCOUNT_ID');
        $testMode = env('PAYU_TEST_MODE');
        $urlConfirmation = env('PAYU_URL_CONFIRMATION');
        $urlResponse = env('PAYU_URL_RESPONSE');
        $currency = env('PAYU_CURRENCY');

        $iva = $invoiceIva / 100;
        $invoiceId = Str::random();
        $signature = md5($apiKey. '~' . $marchantId . '~' . $invoiceId . '~' . $invoiceTotal . '~' . $currency );
        $parameters_args = array(
            'merchantId' => $marchantId,
            'referenceCode' => $invoiceId,
            'description' => "Test PAYU",
            'amount' => $invoiceTotal,
            'tax' => 0,
            'taxReturnBase' => 0,
            'signature' => $signature,
            'accountId' => $accountId,
            'currency' => $currency,
            'buyerEmail' => "test@test.com",
            'test' => $testMode,
            'confirmationUrl' => $urlConfirmation,
            'responseUrl' => $urlResponse,
            'shippingAddress' => 'Calle 36 N # 4-114',
            'shippingCountry' => 'CO',
            'shippingCity' => 'Popayán',
            'billingAddress' => 'Calle 36 N # 4-114',
            'billingCountry' => 'CO',
            'billingCity' => 'Popayán',
            'extra1' => 'CREATEGICA'
        );

        return $parameters_args;
    }

    static public function getConfigMercadoPago(
        $purchaseId, $purchaseTotal, $customerEmail, $countryCode, $project, $description
    ){


//        SDK::setClientId("TEST-f475af46-09c8-4c49-bf0e-9d89f4ac60ea");
//        SDK::setClientSecret("TEST-2916179751806361-091300-0b72d1bc3af5c671594d2c9c591a7bbc-719262693");
//        SDK::setPublicKey(env('MERCADO_PAGO_PUBLIC_KEY'));
        SDK::setAccessToken(env('MERCADO_ACCESS_TOKEN'));

        $preference = new Preference();

        $preference->back_urls = array(
            "success" => env('MERCADO_ACCESS_BACK_URL_SUCCESS'),
            "failure" => env('MERCADO_ACCESS_BACK_URL_FAILURE'),
            "pending" => env('MERCADO_ACCESS_BACK_URL_PENDING')
        );
        $preference->auto_return = "approved";

        //USUARIO O CLIENTE
//        $payer = new Payer();
//
//        $payer->name = "TETE9676555";
//        $payer->surname = "Luevano";
//        $payer->email = "test_user_18075302@testuser.com";
//        $payer->date_created = "2018-06-02T12:58:41.425-04:00";
//        $payer->phone = array(
//            "area_code" => "",
//            "number" => "949 128 866"
//        );
//
//        $payer->identification = array(
//            "type" => "DNI",
//            "number" => "12345678"
//        );
//
//        $payer->address = array(
//            "street_name" => "Cuesta Miguel Armendáriz",
//            "street_number" => 1004,
//            "zip_code" => "11020"
//        );

        //DETALLE DE LA ORDEN DE PAGO

        $item = new Item();
        $item->id = $purchaseId;
        $item->title = $project;
        $item->description = $description;
        $item->category_id = "others";
        $item->quantity = 1;
        $item->currency_id = "COP";
        $item->unit_price = (int)$purchaseTotal;


//        $preference->payer = $payer;
        $preference->items = array($item);
        $ramdon = Str::random(30);
        $preference->external_reference = $ramdon;

        # Save and POST preference
        # Guardar y postear la preferencia
        $preference->save();


        return $preference->init_point;

    }
}
