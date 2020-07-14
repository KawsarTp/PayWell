<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'username'=>'admin',
        'email'=>'admin@example.com',
        'password'=>bcrypt('password'),
    ];
});
