<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewVariableProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('backend/*', function($view)
        {
            $view->with('breadcrumbs', [
                'Home'=> 'xx',
                'Category'=> 'xxxx',
                'Product'=> 'xx'
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
