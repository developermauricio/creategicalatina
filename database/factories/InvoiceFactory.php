<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(\App\Model\Invoice::class, function (Faker $faker) {
    return [
        'code' => '323-12',
        'name' => $faker->userName,
        'note' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'subtotal' => 150000,
        'total' => 120000,
        'iva' => 19,
        'date'=>'2021-09-09',
        'end_date'=>'2021-09-09',
        'expiration'=>'2021-09-09',
    ];
});
