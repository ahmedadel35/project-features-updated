<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Gate;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    use \Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;

    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')->group(base_path('routes/web.php'));
        });

        /** custom gates */

        // allow only category owner to create, see, update and delete it
        Gate::define('see-category', function (User $user, Category $category) {
            return $category->user_id === $user->id;
        });

        /**
         * same as above but category is optional
         *
         * why :
         * for route projects/create
         * then user will select category which
         * will load only owned categorties
         */
        Gate::define('see-category-if-present', function (
            User $user,
            ?Category $category = null
        ) {
            if ($category) {
                return $category->user_id === $user->id;
            }
            return true;
        });

        // allow only project owner to update it
        Gate::define('see-project', function (
            User $user,
            Category $category,
            Project $project
        ) {
            return $project->category_id === $category->id &&
                $category->user_id === $user->id;
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip()
            );
        });
    }
}
