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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Challenge::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(3),
		'summary' => $faker->paragraph(),
		'description' => $faker->paragraphs(3, true),
		'phase' => rand(App\Challenge::PHASE_START, App\Challenge::PHASE_END)
	];
});

$factory->define(App\Resource::class, function (Faker\Generator $faker, $id) {
	return [
		'name' => $faker->sentence(3),
		'url' => $faker->url,
		'description' => $faker->paragraph(),
		'type' => $faker->fileExtension,
		'challenge_id' => null,
		'phase' => null
	];
});
