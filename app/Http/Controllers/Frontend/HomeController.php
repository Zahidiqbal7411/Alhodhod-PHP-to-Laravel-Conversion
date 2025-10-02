<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\BannerAdd;

class HomeController extends Controller
{
 public function index()
    {
        // Use your helper to get active language
        $activeLangKey = get_active_language(); // e.g. 'en', 'fr', 'ar'
        $language_wordings = get_language_wordings(); // returns array for current language

        $activelanguage = config('global.available_languages')[$activeLangKey] ?? 'english';

        $directionn = $activeLangKey === 'ar' ? 'dir="rtl"' : 'dir="ltr"';

        return view('alhodhod_frontend.pages.Home', compact('language_wordings', 'activelanguage', 'directionn'));
    }

}