<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            /**
             * ====================================================
             *   CARGA DINÁMICA de todas las ROUTES establecidas
             * para cada Entidad comprendida en cada Bundle Context
             * ====================================================
             */
            $boundedContexts = ['admin', 'manager', 'app', 'landing'];
            foreach ($boundedContexts as $boundedContext) {
                if (is_dir(base_path("src/$boundedContext"))) {
                    foreach (File::allFiles(base_path("src/$boundedContext/**/infrastructure/routes")) as $routeFile) {
                        $type = explode(".", $routeFile->getBasename())[0];
                        Route::prefix($type)
                            ->middleware($type)
                            ->group($routeFile->getRealPath());
                    }
                }
            }
            // ====================================================
        });
    }
}
