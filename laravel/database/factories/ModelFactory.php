<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'gebruikersnaam' => $faker->username,
        'voornaam' => $faker->firstName,
        'achternaam' => $faker->lastName,
        'geboortedatum' => $faker->date,
        'geslacht' => $faker->randomLetter,
        'MAILADRES' => $faker->unique()->safeEmail,
        'WACHTWOORD' => $password ?: $password = bcrypt('tmp123')
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'gebruikerID' => 1,
        'omschrijving' => $faker->sentence,
        'locatieID' => 1,
        'status' => $faker->sentence(3, true)
    ];
});
