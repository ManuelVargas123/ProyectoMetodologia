<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//Se importa "the blade objects"
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Veriricar si el usuario es Admin
        Blade::if('isAdmin', function(){
            if(Auth::check())
                return Auth::user()->is_admin === 1 ? true : false;
            else
                return false;
        });
        //Verificar si el usuario es trabajador
        Blade::if('isWorker', function(){
            if(Auth::check())
                return Auth::user()->is_admin === 0 ? true : false;
            else
                return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
