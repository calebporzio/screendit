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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'last_read_announcements_at' => Carbon\Carbon::now(),
    ];
});

$factory->state(App\User::class, 'on-trial', function (Faker\Generator $faker) {
	return [
        'trial_ends_at' => Carbon\Carbon::now()->addDays(Laravel\Spark\Spark::trialDays()),
    ];
});

$factory->define(App\Screenshot::class, function (Faker\Generator $faker) {
    return [
    	'url' => $faker->url,
	    'viewport' => '',
	    'crop' => '',
	    'hide_lightboxes' => false,
	    'cached' => false,
	    'format' => 'png',
        'expires_at' => Carbon\Carbon::now()->addMonth(),
    ];
});
