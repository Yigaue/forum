<?php

namespace App\Providers;
use App\Channel;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\View;
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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
 
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view::composer('*', function($view){
            $channels = \Cache::rememberForever('channels', function(){
                return Channel::all();
            
        });
        $view->with('channels', $channels);
    });
    }
}
