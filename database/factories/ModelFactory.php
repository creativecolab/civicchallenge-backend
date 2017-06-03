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

    return [
	    'slack_id' => 'U' . str_random(6),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail
    ];
});

$factory->define(App\Challenge::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(3),
		'summary' => $faker->paragraph(),
		'description' => $faker->paragraphs(3, true),
		'phase' => rand(App\Challenge::PHASE_START, App\Challenge::PHASE_END),
		'category_id' => null
	];
});

$factory->define(App\Resource::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(3),
		'url' => $faker->url,
		'description' => $faker->paragraph(),
		'type' => $faker->fileExtension,
		'challenge_id' => null,
		'phase' => null
	];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->sentence(3),
		'description' => $faker->paragraph(),
		'thumbnail' => $faker->imageUrl()
	];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
	return [
		'text' => $faker->sentence(),
		'challenge_id' => null,
		'phase' => null
	];
});

$factory->define(App\Insight::class, function (Faker\Generator $faker) {
	return [
		'text' => $faker->sentence(),
		'user_id' => null,
		'timestamp' => $faker->date(),
		'thumbnail' => $faker->imageUrl(),
		'type' => rand(App\Insight::TYPE_MIN, App\Insight::TYPE_MAX),
		'question_id' => null,
		'challenge_id' => null,
		'phase' => null,
		'slack_meta' => '{"var1": "content"}'
	];
});
