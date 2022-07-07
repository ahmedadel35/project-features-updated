<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth'])
    ->name('dashboard');

Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeCookieRedirect'])
    ->group(function () {
        require __DIR__ . '/auth.php';

        Route::middleware('auth')->group(function () {
            Route::resource('categories', CategoryController::class)->only([
                'index',
                'create',
                'store',
            ]);

            Route::resource('categories', CategoryController::class)
                ->except(['index', 'create', 'store'])
                ->middleware('can:see-category,category');
        });
    });
