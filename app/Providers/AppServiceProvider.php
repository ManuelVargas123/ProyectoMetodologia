<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        /*
            Arreglar el problema de la base de datos con el token
            de la table Users
            MySQL ha dicho:
            #1071 - Declaracion de clave demasiado larga. La maxima longitud de clave es 767
       */
        Schema::defaultStringLength(191);

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
