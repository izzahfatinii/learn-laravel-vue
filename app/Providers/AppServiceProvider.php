<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind to container
        app()->bind('Hello', function (){
            return 'Hi';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // try custom response using macro
        Response::macro('caps', function (string $value) {
            return Response::make(strtoupper($value));
        }); 
    }
}
