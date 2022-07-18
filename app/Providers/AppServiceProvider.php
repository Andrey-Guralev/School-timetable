<?php

namespace App\Providers;

use App\Contracts\TimetableParser\TimetableXmlParser;
use App\Contracts\Translit\Translit as TranslitInterface;
use App\Services\TimetableParser\TimetableParser;
use App\Services\Translit\Translit;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TranslitInterface::class, function ($app) {
            return new Translit;
         });

        $this->app->bind(TimetableXmlParser::class, function ($app) {
            return new TimetableParser;
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
