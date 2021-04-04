<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\CompanyCategory;
use Faker\Generator as Faker;

$factory->define(CompanyCategory::class, function (Faker $faker) {
    return [
        'id'=>null,
        'name'=>$faker->jobTitle,
        'description'=>$faker->sentence
    ];
});
