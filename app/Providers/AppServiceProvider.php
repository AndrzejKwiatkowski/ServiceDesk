<?php

namespace App\Providers;

use App\Services\TicketService;
use App\Services\TicketServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        $this->app->bind(TicketServiceInterface::class, TicketService::class);
        // to nie jest nic strasznego,
        // to znaczy tylko tyle, ze kiedykolwiek będę wołał o TicketServiceInterface to masz postawić TicketService,
        // jeżeli jesteś ciekawy to poczytaj o service containerach w laravelu,
        // czemu tak robię, to po prostu dobra praktyka, i przydaję się jak np chcesz nadpisać jakieś klasy z vendora,
        // wtedy extendujesz swoją klase klasą którą chcesz nadpisać i tu bindujesz klasę którą chcesz nadpisać do swojek klasy,
        // np. chce zmienić działanie Illuminate\Http\Request, wtedy tworzę sobię klasę np CustomRequest i extenduje ją Illuminate\Http\Request,
        // następnie zmieniam sobie jakieś jej działąnie i tutaj daje $this->app->bind(Illuminate\Http\Request, CustomRequest::class);,
        // wtedy laravel wie że jak kiedykolwiek zostanie poproszony o Illuminate\Http\Request to ma postawić CustomRequest, zachowuje zgodność wstecz
        // i przecież CustomRequest zachowuje całą funkcjonalność Illuminate\Http\Request, bo go extenduje i jest gitarka
    }
}
