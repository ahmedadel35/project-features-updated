<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Vite;
use JMac\Testing\Traits\AdditionalAssertions;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    TestCase::class,
    AdditionalAssertions::class,
    RefreshDatabase::class,
    WithFaker::class
)->in(__DIR__);


/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function actingAs(?User $user = null)
{
    $user = $user ?: User::factory()->create();

    return test()->actingAs($user);
}

/**
 * create user with all relatoships
 *
 * @param User|null $user
 * @param integer $todos_count
 * @param integer $categories_count
 * @param integer $products_count
 * @return array
 */
function userWithTodos(?User $user = null, int $todos_count = 1, int $categories_count = 1, int $products_count = 1): array
{
    $user = $user ?? User::factory()->create();
    $cats = Category::factory()->count($categories_count)->for($user)->create();

    $projs = Project::factory()->count($products_count)->create([
        'category_id' => $cats->first()->id,
    ]);

    $todos = Todo::factory()->count($todos_count)->create([
        'project_id' => $projs->first()->id,
    ]);

    /** @var \App\Models\Category $cat */
    $cat = $categories_count === 1 ? $cats->first() : $cats;

    return [$user, $cat, $todos];
}

function routel(string $name, mixed $var = []): string
{
    return Str::replace('/en', '', route($name, $var));
}