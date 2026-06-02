<?php

namespace App\Providers;

use App\View\Composers\AnnouncementComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination.index');

        View::composer('layout.employee.announcement-icon', AnnouncementComposer::class);
    }
}
