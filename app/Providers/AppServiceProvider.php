<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency_converter',function (){
          return   new CurrencyConverter(config('services.currency_converter.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        // JsonResource::withoutWrapping();

        Validator::extend('filter',function ($attribute,$value,$params){
            return !in_array(strtolower($value),$params);
        },'this value is not allowed!');

        Paginator::useBootstrap();
    }
}
