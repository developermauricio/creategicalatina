<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const REVISION = 1;
    const BORRADOR = 2;
    const APPROVED = 3;
    const PAID = 4;
    const REJECTED = 5;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function invoiceItems(){
        return $this->hasMany(InvoiceItems::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
