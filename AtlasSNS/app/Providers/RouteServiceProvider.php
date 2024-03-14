<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

//         //ログアウト中のページ
//         $this->mapGuestRoutes();
// 　　　　　//ログイン中のページ
//         $this->mapAuthRoutes();

    }

//     // guest.phpルートファイルの設定です。
// protected function mapGuestRoutes()
//     {
//         // guest.phpの記述には制限を付けないので、middlewareにデフォルトの'web'のみを適用しています
//         Route::middleware('web')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/guest.php'));     // ここでファイルのパスを設定しています
//     }

// // auth.phpルートファイルの設定です。
// protected function mapAuthRoutes()
//     {
//         // auth.phpでは認証されたユーザーのみアクセスできるようにします。
//         // そのため、middlewareに'auth'を記述しています。
//         Route::middleware('web', 'auth')
//             ->namespace($this->namespace)
//             ->group(base_path('routes/auth.php'))

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
