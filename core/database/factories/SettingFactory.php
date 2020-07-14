<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'comission'=> 3,
        'trans_bonus'=>2,
        'charge'=>3,
        'bonusall'=>0
    ];
});
