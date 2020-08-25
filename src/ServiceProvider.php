<?php

namespace Wavpa\ExchangeRate;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(ExchangeRate::class, function(){
            return new ExchangeRate(config('services.exchange-rate.key'));
        });

        $this->app->alias(ExchangeRate::class, 'exchange-rate');
    }

    public function provides()
    {
        return [ExchangeRate::class, 'exchange-rate'];
    }
}