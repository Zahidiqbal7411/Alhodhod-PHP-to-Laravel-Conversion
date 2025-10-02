<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
{
    // Add this property inside the class
    public $dependsOn = [
        \Illuminate\View\ViewServiceProvider::class,
    ];

    public function boot()
    {
        // Use a wildcard '*' to bind data to all views
        View::composer('*', function ($view) {

            // Check helper functions exist to avoid errors
            if (!function_exists('get_active_language') || !function_exists('get_language_wordings')) {
                return;
            }

            $activelanguage = get_active_language();
            $language_wordings = get_language_wordings();

            // Fetch pages and menus from DB
            $pages = Page::all();
            $menus = Menu::all();
            $menusGroupedByPage = $menus->groupBy('page_id')->toArray();

            // Determine text direction
            $directionn = ($activelanguage === 'arabic' || $activelanguage === 'ar')
                ? 'dir="rtl" style="text-align:right;"'
                : 'dir="ltr"';

            // Share all variables with the view
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
        //
    }
}
