<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Company::class, function (Faker $faker) {
    $name = $faker->company;
    $ramdon = Str::random(10);
    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        "phone"=> $faker->numberBetween(),
        'address' => $faker->address,
        'biography' => $faker->sentence,
        "nit"=> $faker->numberBetween(),
//        "picture"=> '/images/img-logo-empresa.png',
        'city_id' => \App\Model\City::all()->random()->id,
        'country_id' => \App\Model\Country::all()->random()->id,
        'company_category_id' => \App\Model\CompanyCategory::all()->random()->id,
        'slug' => Str::slug($name .'-'. $ramdon, '-'),
    ];
});
