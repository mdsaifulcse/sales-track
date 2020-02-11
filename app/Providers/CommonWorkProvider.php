<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class CommonWorkProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('commonWork',function (){
            return New \App\Http\Controllers\CommonWorkController;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
