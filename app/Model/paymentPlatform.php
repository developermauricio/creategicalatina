<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paymentPlatform extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image',
    ];
}
