<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\BannerAdd;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Chapter;
use App\Models\Word;
use App\Models\Dream;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $lang;
    private $activelanguage;
    private $directionn;
    private $leftArrow;
    private $rightArrow;

    public function __construct()
    {
        $langParam = request()->query('lang');
        if ($langParam) {
            session(['applocale' => $langParam]);
            app()->setLocale($langParam);
        }

        $this->lang = session('applocale', get_active_language());

        $this->activelanguage = config('global.available_languages')[$this->lang] ?? 'english';
        $this->directionn = $this->lang === 'ar' ? 'dir="rtl"' : 'dir="ltr"';
        $this->leftArrow = $this->lang === 'ar' ? '❯' : '❮';
        $this->rightArrow = $this->lang === 'ar' ? '❮' : '❯';
    }

    public function index()
    {
        $language_wordings = get_language_wordings();

        $pages = Page::with('menus')->get();

        $articles = Article::select('article_title', 'article_slug', 'article_image', 'content')
            ->where('lang', $this->lang)
            ->where('show_on_home_page', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('alhodhod_frontend.pages.Home', [
            'language_wordings' => $language_wordings,
            'activelanguage'    => $this->activelanguage,
            'directionn'        => $this->directionn,
            'articles'          => $articles,
            'lang'              => $this->lang,
            'leftArrow'         => $this->leftArrow,
            'rightArrow'        => $this->rightArrow,
            'pages'             => $pages,
        ]);
    }

    public function menuArticles($id)
    {
        $language_wordings = get_language_wordings();

        $menu = Menu::with(['article' => function ($query) {
            $query->where('lang', $this->lang);
        }])->findOrFail($id);

        return view('alhodhod_frontend.pages.Home', [
            'language_wordings' => $language_wordings,
            'activelanguage'    => $this->activelanguage,
            'directionn'        => $this->directionn,
            'lang'              => $this->lang,
            'leftArrow'         => $this->leftArrow,
            'rightArrow'        => $this->rightArrow,
            'menu'              => $menu,
            'articles'          => $menu->article,
        ]);
    }

    public function dreamData(Request $request)
    {
        $action = $request->query('action');

        if ($action !== 'data') {
            return response()->json(['error' => 'Invalid action'], 400);
        }

        $data = [];
        $chapters = Chapter::with(['words.dreams'])->get();

        foreach ($chapters as $chapter) {
            $chapterTitle = trim($chapter->chapter_title);
            if (!isset($data[$chapterTitle])) {
                $data[$chapterTitle] = [];
            }

            $data[$chapterTitle]['chapter_details'] = trim($chapter->chapter_details);
            $data[$chapterTitle]['chapter_slug'] = trim($chapter->chapter_slug);

            foreach ($chapter->words as $word) {
                $wordTitle = trim($word->word_title);
                if (!isset($data[$chapterTitle][$wordTitle])) {
                    $data[$chapterTitle][$wordTitle] = [];
                }

                $data[$chapterTitle][$wordTitle]['word_slug'] = trim($word->word_slug);

                foreach ($word->dreams as $dream) {
                    $dreamTitle = trim($dream->dream_title);
                    $data[$chapterTitle][$wordTitle][$dreamTitle] = [
                        'dream_slug' => trim($dream->dream_slug),
                        'meaning'    => trim($dream->dreams_meaning),
                    ];
                }
            }
        }

        $ads = BannerAdd::where('ad_type', 3)
            ->where('ad_status', 1)
            ->where('ar', 1)
            ->orderByDesc('created_at')
            ->get(['id', 'ad_url', 'ad_text', 'ad_link'])
            ->all();

        $bannerAdPath = config('app.banner_ad_path');

        $data['_ads'] = array_map(function ($ad) use ($bannerAdPath) {
            $base = rtrim($bannerAdPath, '/');
            $path = ltrim($ad->ad_url, '/');
            return [
                'id'   => (int) $ad->id,
                'url'  => "{$base}{$path}",
                'text' => trim($ad->ad_text ?? ''),
                'link' => trim($ad->ad_link ?? ''),
            ];
        }, $ads);

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show($slug)
    {
        $article = Article::where('article_slug', $slug)->firstOrFail();

        $related_articles = Article::where('menu_id', $article->menu_id)
            ->where('article_slug', '!=', $slug)
            ->where('lang', $this->lang)
            ->get();

        return view('alhodhod_frontend.layouts.article', compact('article', 'related_articles'));
    }
}
