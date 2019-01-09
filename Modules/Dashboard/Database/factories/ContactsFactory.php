<?php

use Faker\Generator as Faker;

$factory->define(Modules\Dashboard\Entities\Contacts::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'age' => $faker->numberBetween(18, 55),
        'gender' => $faker->randomElement($array = array ('male','female','other'))
    ];
});
