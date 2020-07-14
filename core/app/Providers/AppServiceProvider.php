<?php

namespace App\Providers;

use App\Currency;
use Facade\FlareClient\View;
use Illuminate\Support\ServiceProvider;

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
    
        $currency_status = Currency::where('status',1)->first();
        if($currency_status == null){
            $currency_name = '';
            view()->share('currency_name', $currency_name);
        }else{
            $currency_name = $currency_status->currency;
            view()->share('currency_name', $currency_name);
        }


    }
}
