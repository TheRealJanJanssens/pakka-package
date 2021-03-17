<?php

namespace TheRealJanJanssens\Pakka\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach(glob( __DIR__."/../Helpers/*.php" ) as $filename){
            require_once($filename);
        }
    }
}
