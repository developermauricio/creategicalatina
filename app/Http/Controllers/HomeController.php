<?php

namespace App\Http\Controllers;

use App\Model\Currency;
use App\Model\paymentPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function indexPayment()
    {
        $listCurrencies = Currency::all();
        $listPaymentPlatforms = paymentPlatform::all();
        $currentUser = $user = auth()->user();

        return view('payment.payment', compact('listCurrencies', 'listPaymentPlatforms', 'currentUser'));
    }
}
