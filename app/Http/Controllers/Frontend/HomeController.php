<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\BannerAdd;
use App\Models\Article;

class HomeController extends Controller
{
public function index()
{
    $lang = get_active_language();

    $language_wordings = get_language_wordings();
    $activelanguage = config('global.available_languages')[$lang] ?? 'english';
    $directionn = $lang === 'ar' ? 'dir="rtl"' : 'dir="ltr"';

    $articles = Article::select('article_title', 'article_slug', 'article_image', 'content')
        ->where('lang', $lang)
        ->where('show_on_home_page', 1)
        ->orderBy('created_at', 'desc')
        ->get();

    $leftArrow = $lang === 'ar' ? '❯' : '❮';
    $rightArrow = $lang === 'ar' ? '❮' : '❯';

    return view('alhodhod_frontend.pages.Home', compact(
        'language_wordings',
        'activelanguage',
        'directionn',
        'articles',
        'lang',
        'leftArrow',
        'rightArrow'
    ));
}

}