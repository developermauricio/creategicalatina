<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {

    $name = $faker->name;
    $ramdon = Str::random(10);
    return [
        'name'=>$faker->name,
        'description'=>$faker->sentence,
        'observations'=>$faker->sentence,
        'description_short'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'link'=>$faker->url,
        "picture"=> '/images/img-logo-empresa.png',
        'state'=> Project::REVISION,
        'end_time'=>'2021-09-09',
        'type_project_id'=>2,
        'slug' => Str::slug($name .'-'. $ramdon, '-'),
    ];
});
