<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Blade; 

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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });



        Blade::directive('permission', function($expression) {
            return "<?php if (in_array($expression, Auth::user()->permissions->pluck('name')->all())) : ?>";
        });

        Blade::directive('endpermission', function($expression) {
            return "<?php endif; ?>";
        });
    }
}
