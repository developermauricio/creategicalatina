<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {

    $ramdon = Str::random(10);
    return [
        'code' => '323-12',
        'note' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'subtotal' => 150000,
        'total' => 120000,
        'iva' => 19,
        'slug' => Str::slug('323-12' .'-'. $ramdon, '-'),
        'date'=>'2021-09-09',
        'end_date'=>'2021-09-09',
        'expiration'=>'2021-09-09',
    ];
});
