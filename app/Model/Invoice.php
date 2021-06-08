<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const REVISION = 1;
    const BORRADOR = 2;
    const APPROVED = 3;
    const PAID = 4;
    const REJECTED = 5;

}
