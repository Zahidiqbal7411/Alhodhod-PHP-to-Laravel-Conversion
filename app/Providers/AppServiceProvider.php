<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Choose one based on your Bootstrap version:
         Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        View::composer('*', function ($view) {
            // Make sure helper functions exist before using
            if (!function_exists('get_active_language') || !function_exists('get_language_wordings')) {
                return;
            }

            $activelanguage = get_active_language();
            $language_wordings = get_language_wordings();

            $pages = Page::all();
            $menus = Menu::all();
            $menusGroupedByPage = $menus->groupBy('page_id')->toArray();

            $directionn = ($activelanguage === 'arabic' || $activelanguage === 'ar')
                ? 'dir="rtl" style="text-align:right;"'
                : 'dir="ltr"';

            $view->with(compact(
                'activelanguage',
                'language_wordings',
                'pages',
                'menusGroupedByPage',
                'directionn'
            ));
        });
    }

    public function register()
    {
        // Your existing register logic here
    }
}
