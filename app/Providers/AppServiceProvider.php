<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Kalau error tambahin ini
//use Illuminate\Support\Facades\Schema; 

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
        // kalau error pakai ini juga
        //Schema::defaultStringLength(255);
    }
}
