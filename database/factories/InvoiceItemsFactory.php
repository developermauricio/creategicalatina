<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\InvoiceItems;
use Faker\Generator as Faker;

$factory->define(InvoiceItems::class, function (Faker $faker) {
    return [
        'item' => 'Desarrollo de Software',
        'price' => 200000,
        'quantity' => 1,
        'value_final' => 200000
    ];
});
