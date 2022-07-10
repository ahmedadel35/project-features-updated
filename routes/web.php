<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
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
                // 'create',
                'store',
            ]);

            Route::middleware('can:see-category,category')->group(function () {
                Route::resource(
                    'categories',
                    CategoryController::class
                )->except(['index', 'create', 'store']);

                // projects
                // Route::get('c/{category}/projects', [
                //     ProjectController::class,
                //     'index',
                // ])->name('categories.show');
                Route::resource(
                    'c/{category}/projects',
                    ProjectController::class
                )->only([
                    // 'index',
                    'create',
                    'store',
                ]);

                Route::prefix('c/{category}')
                    ->middleware('can:see-project,category,project')
                    ->group(function () {
                        Route::resource('projects', ProjectController::class)->except([
                            'index',
                            'create',
                            'store',
                        ]);

                        Route::post('/{project}/invite', [
                            ProjectController::class,
                            'invite',
                        ])->name('projects.invite');
                    });
            });
        });
    });
