<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerNatural extends Model
{
    public function customer(){
        return $this->morphMany(Customer::class, 'customeable');
    }

}
