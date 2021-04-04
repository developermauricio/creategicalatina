<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\TypeProject;
use Faker\Generator as Faker;

$factory->define(TypeProject::class, function (Faker $faker) {
    return [
        'id'=>null,
        'name'=>$faker->jobTitle,
        'description'=>$faker->sentence
    ];
});
