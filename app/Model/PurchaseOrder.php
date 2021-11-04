<?php

namespace App\Model;

use App\Models\ItemsPurchaseOrder;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    const PENDING_PAY = 1;
    const BORRADOR = 2;
    const PAID = 3;
    const REJECTED = 4;

    const MANUAL = 1;
    const ONLINE = 2;
    const PENDING = 3;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function purchaseItems(){
        return $this->hasMany(ItemsPurchaseOrder::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function history(){
        return $this->hasMany(HistorialPurchaseOrder::class,  'id_purchase');
    }

}
