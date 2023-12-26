<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        Paginator::defaultView('vendor.pagination.custom-paginate');

       Facades\View::composer('dash.include.header',function (View $view){
        $view->with(['unseenComments' => Comment::where('seen',0)->get(),'notifications' => Notification::where('read_at',0)->get()]);
       });
    }
}
