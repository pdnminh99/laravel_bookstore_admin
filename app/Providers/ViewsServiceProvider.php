<?php

namespace App\Providers;

use App\Contracts\BookService;
use App\Contracts\DefaultBookService;
use App\View\Components\UserControl;
//use App\View\Components\SearchBar;
use App\View\Components\SideNav;
use App\View\Components\TopNav;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
//use App\View\Components\SideNavButton;

class ViewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BookService::class, DefaultBookService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Sidenav
//        Blade::component('sidenav-btn-component', SideNavButton::class);
        Blade::component('sidenav-container', SideNav::class);

        // Topnav
        Blade::component('topnav-container', TopNav::class);
//        Blade::component('searchbar-component', SearchBar::class);
        Blade::component('user-control-component', UserControl::class);
    }
}
