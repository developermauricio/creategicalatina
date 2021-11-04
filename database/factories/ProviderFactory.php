<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'position_id' => \App\Model\PositionManager::all()->random()->id,
        'company_category_id' => \App\Model\CompanyCategory::all()->random()->id,
    ];
});
