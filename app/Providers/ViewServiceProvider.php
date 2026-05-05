<?php
 
namespace App\Providers;
 
use App\View\ApplistComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
 
class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        View::composer('layouts._sidebar', ApplistComposer::class);
        View::composer('visits.index',ApplistComposer::class);
        
    }
}