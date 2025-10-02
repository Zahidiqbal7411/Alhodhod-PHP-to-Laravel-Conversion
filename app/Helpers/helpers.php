<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use App\Models\ZChapter;
use App\Models\ZWord;
use App\Models\ZDream;
use App\Models\BannerAdd;

if (!function_exists('get_chapter_lang_by_slug')) {
    function get_chapter_lang_by_slug($slug)
    {
        return ZChapter::where('chapter_slug', $slug)->value('lang');
    }
}

if (!function_exists('get_word_lang_by_slug')) {
    function get_word_lang_by_slug($slug)
    {
        return ZWord::where('word_slug', $slug)->value('lang');
    }
}

if (!function_exists('get_dream_lang_by_slug')) {
    function get_dream_lang_by_slug($slug)
    {
        return ZDream::where('dream_slug', $slug)->value('lang');
    }
}

if (!function_exists('get_active_language')) {
    function get_active_language()
    {
        $available_languages = config('global.available_languages');

        $type = request()->get('type');
        $slug = request()->get('slug');

        if (in_array($type, ['chapter', 'word', 'dream']) && $slug) {
            if ($type === 'chapter') {
                $lang = get_chapter_lang_by_slug($slug);
            } elseif ($type === 'word') {
                $lang = get_word_lang_by_slug($slug);
            } elseif ($type === 'dream') {
                $lang = get_dream_lang_by_slug($slug);
            } else {
                $lang = null;
            }

            if ($lang && array_key_exists($lang, $available_languages)) {
                return $lang;
            }
        }

        $lang = request()->get('lang');
        if ($lang && array_key_exists($lang, $available_languages)) {
            Cookie::queue('activelanguage', $lang, 60 * 24 * 365); // 1 year
            return $lang;
        }

        return Cookie::get('activelanguage', 'en');
    }
}

if (!function_exists('get_language_wordings')) {
    function get_language_wordings()
    {
        $language_wordings = config('global.language_wordings');

        $language_key = get_active_language();

        $lang_name = config('global.available_languages')[$language_key] ?? 'english';

        return $language_wordings[$lang_name];
    }
}

if (!function_exists('get_tables')) {
    function get_tables()
    {
        $lang = get_active_language();
        $suffixes = config('global.table_suffixes');

        $suffix = $suffixes[$lang] ?? 'english';

        return [
            'parent_table' => 'dream_subject_' . $suffix,
            'child_table' => 'dream_desc_' . $suffix,
        ];
    }
}

if (!function_exists('base_url')) {
    function base_url()
    {
        return url('/');
    }
}

if (!function_exists('meta_path')) {
    function meta_path()
    {
        return trim(Request::path(), '/');
    }
}

// if (!function_exists('get_ads')) {
//     function get_ads($type)
//     {
//         $activeLanguage = get_active_language();
//         $available_languages = config('global.available_languages');
//         $lang_column = $available_languages[$activeLanguage] ?? 'english';

//         $base_url = config('global.ads_base_url');

//         $ads = DB::table('banner_ads')
//             ->where('ad_type', $type)
//             ->where($lang_column, '1')
//             ->where('ad_status', '1')
//             ->get()
//             ->map(function ($ad) use ($base_url) {
//                 if (!preg_match('/^(http:\/\/|https:\/\/)/', $ad->ad_url) && strpos($ad->ad_url, 'uploads/') !== false) {
//                     $ad->ad_url = $base_url . $ad->ad_url;
//                 }
//                 return $ad;
//             });

//         return $ads;
//     }
// }

if (!function_exists('get_ads')) {
    /**
     * Get ads by type with active language and base URL handling.
     * 
     * @param int $type
     * @return \Illuminate\Support\Collection
     */
    function get_ads($type)
    {
        $activeLanguage = get_active_language(); // e.g. 'en', 'fr', 'ar'
        $available_languages = config('global.available_languages');

        // Use the language key as the column name
        $lang_column = array_key_exists($activeLanguage, $available_languages)
            ? $activeLanguage
            : 'en';

        $base_url = config('global.ads_base_url');

        // Make sure model name is correct: BannerAd, not BannerAdd
        $ads = BannerAdd::where('ad_type', $type)
            ->where($lang_column, '1')
            ->where('ad_status', '1')
            ->get()
            ->map(function ($ad) use ($base_url) {
                if (!preg_match('/^(http:\/\/|https:\/\/)/', $ad->ad_url) && strpos($ad->ad_url, 'uploads/') !== false) {
                    $ad->ad_url = $base_url . $ad->ad_url;
                }
                return $ad;
            });

        return $ads;
    }
}

