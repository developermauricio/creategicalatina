<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Manager;
use Faker\Generator as Faker;

$factory->define(Manager::class, function (Faker $faker) {
    return [
        'position_id' => \App\Model\PositionManager::all()->random()->id,
    ];
});
