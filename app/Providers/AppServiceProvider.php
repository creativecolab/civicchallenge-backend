<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Schema::defaultStringLength(191);

	    Validator::extend('numberList', function($attribute, $value, $parameters, $validator) {
	    	return preg_match('/^\d+(?:,\d+)*$/', $value);
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    if ($this->app->environment() !== 'production') {
		    $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
	    }
    }
}
