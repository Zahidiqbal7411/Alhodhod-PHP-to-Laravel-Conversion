<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\BannerAdd;
use App\Models\Article;

use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use App\Models\Word;
use App\Models\Dream;

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



public function dreamData(Request $request)
{
    $action = $request->query('action');

    if ($action === 'data') {
        $data = [];

        // ✅ Eager-load words and dreams for all chapters
        $chapters = Chapter::with(['words.dreams'])->get();

        foreach ($chapters as $chapter) {
            $chapterTitle = trim($chapter->chapter_title);
            $data[$chapterTitle] = [
                'chapter_details' => trim($chapter->chapter_details),
                'chapter_slug'    => trim($chapter->chapter_slug),
            ];

            foreach ($chapter->words as $word) {
                $wordTitle = trim($word->word_title);
                $data[$chapterTitle][$wordTitle] = [
                    'word_slug' => trim($word->word_slug),
                ];

                foreach ($word->dreams as $dream) {
                    $dreamTitle = trim($dream->dream_title);
                    $data[$chapterTitle][$wordTitle][$dreamTitle] = [
                        'dream_slug' => trim($dream->dream_slug),
                        'meaning'    => trim($dream->dreams_meaning),
                    ];
                }
            }
        }

        // ✅ Include banner ads (can optionally use a model)
        $ads = DB::table('banner_ads')
            ->select('id', 'ad_url', 'ad_text', 'ad_link')
            ->where([
                ['ad_type', '=', 3],
                ['ar', '=', 1],
                ['ad_status', '=', 1],
            ])
            ->orderByDesc('created_at')
            ->get();

        // Optionally set from config or .env
        $bannerAdPath = config('app.banner_ad_path', '/banner_ads');

        $data['_ads'] = $ads->map(function ($ad) use ($bannerAdPath) {
            return [
                'id'   => (int) $ad->id,
                'url'  => rtrim($bannerAdPath, '/') . '/' . ltrim($ad->ad_url, '/'),
                'text' => trim($ad->ad_text),
                'link' => trim($ad->ad_link),
            ];
        })->toArray();

        // ✅ Return response
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    return response()->json(['error' => 'Invalid action'], 400);
}


}