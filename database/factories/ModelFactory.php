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

use App\Models;

/**
 * Ability
 */
$factory->define(Models\Ability::class, function (Faker\Generator $faker) {
    return [
        'key' => 'test-ability',
        'description' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});

$factory->defineAs(Models\Ability::class, 'admin', function (Faker\Generator $faker) use ($factory) {
    $ability = $factory->raw(Models\Ability::class);

    return array_merge($ability, ['key' => '*']);
});

$factory->defineAs(Models\Ability::class, 'academia', function (Faker\Generator $faker) {
    return [];
});

/**
 * Role
 */
$factory->define(Models\Role::class, function (Faker\Generator $faker) {
    $role = $faker->word;

    return [
        'name' => $role,
        'label' => ucfirst($role),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});

$factory->defineAs(Models\Role::class, 'admin', function (Faker\Generator $faker) use ($factory) {
    $role = $factory->raw(Models\Role::class);

    return array_merge($role, ['name' => 'admin']);
});

$factory->defineAs(Models\Role::class, 'academia', function (Faker\Generator $faker) use ($factory) {
    $role = $factory->raw(Models\Role::class);

    return array_merge($role, ['name' => 'academia']);
});

/**
 * User
 */
$factory->define(Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'slug' => $faker->unique()->slug(2, false),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'middle_name' => $faker->firstName,
        'photo' => $faker->imageUrl(),
        'email' => $faker->safeEmail,
        'phone' => $faker->numerify('070########'),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

//System user, for mimicing user actions
$factory->defineAs(Models\User::class, 'system', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(Models\User::class);

    return array_merge($user, ['email' => 'server@aspes.msc'], ['first_name' => 'ASPES'], ['last_name' => 'Developers']
    );
});

/**
 * Exercises
 */
$factory->define(Models\Exercise::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(),
        'state' => Models\Exercise::IS_DRAFT,
        'start_at' => $faker->dateTimeBetween('-1 month', 'now'),
        'stop_at' => $faker->dateTimeBetween('+1 week', '+1 month'),
    ];
});

/**
 * Comment
 */
$factory->define(Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'exercise_id' => Models\Exercise::all()->random()->id,
        'value' => $faker->text(20),
        'grade' => $faker->randomNumber(2, true),
    ];
});

/**
 * Evaluator
 */
$factory->define(Models\Evaluator::class, function (Faker\Generator $faker) {
    return [
        'exercise_id' => Models\Exercise::all()->random()->id,
        'user_id' => Models\User::all()->random()->id,
        'type' => $faker->randomElement([Models\Evaluator::DM, Models\Evaluator::SE]),
    ];
});

/**
 * Factor
 */
$factory->define(Models\Factor::class, function (Faker\Generator $faker) {
    return [
        'exercise_id' => Models\Exercise::all()->random()->id,
        'text' => $faker->text(30)
    ];
});

/**
 * FCV
 */
$factory->define(Models\FCV::class, function (Faker\Generator $faker) {
    $l = $faker->randomFloat(3, 0, 1);
    $m = $faker->randomFloat(3, $l, $l * 1.5);
    $u = $faker->randomFloat(3, $m, $l * 2);

    return [
        'exercise_id' => Models\Exercise::all()->random()->id,
        'name' => $faker->word,
        'value' => [$l, $m, $u],
    ];
});

/**
 * Subject
 */
$factory->define(Models\Subject::class, function (Faker\Generator $faker) {
    return [
        'exercise_id' => Models\Exercise::all()->random()->id,
        'user_id' => Models\User::all()->random()->id,
    ];
});

/**
 * Comparison
 */
$factory->define(Models\Comparison::class, function (Faker\Generator $faker) {
    return [
        'f1_id' => Models\Factor::all()->random()->id,
        'f2_id' => Models\Factor::all()->random()->id,
        'fcv__id' => Models\FCV::all()->random()->id,
        'evaluator_id' => Models\Evaluator::all()->random()->id,
    ];
});

/**
 * Evaluation
 */
$factory->define(Models\Evaluation::class, function (Faker\Generator $faker) {
    return [
        'evaluator_id' => Models\Evaluator::all()->random()->id,
        'factor_id' => Models\Factor::all()->random()->id,
        'subject_id' => Models\Subject::all()->random()->id,
        'comment_id' => Models\Comment::all()->random()->id,
    ];
});

