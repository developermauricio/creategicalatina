<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver) {
        $this->middleware('auth');
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
}
