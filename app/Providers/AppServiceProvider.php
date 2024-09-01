<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // httpsに強制リダイレクトさせるのは本番環境のみにする
        if (\App::environment('production')) {
            URL::forceScheme('https');
        }

    // URL::forceScheme('https');
    }
}
