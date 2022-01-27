<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ModelPage;
use Faker\Generator as Faker;

$factory->define(ModelPage::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

    ];
});
