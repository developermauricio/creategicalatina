<?php

namespace App\Http\Middleware\Frontend;

use App\Model\Company;
use App\Model\Customer;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HasCompanies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $customer = Auth::user()->customer;
        $company = Company::where('customer_id', $customer->id)->get();
        $has = null;
        if (count($company) > 0){
            return $next($request);
        }else{
            Customer::SetMessage(__('alert_empresas_clientes_ruta'));
            return back();
        }

    }
}
