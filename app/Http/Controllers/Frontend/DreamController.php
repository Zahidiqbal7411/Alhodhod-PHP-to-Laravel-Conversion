<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ZChapter;
use App\Models\ZWord;
use App\Models\ZDream;

class DreamDataController extends Controller
{
    public function showDreamView()
    {
        $data = [];

        $chapters = ZChapter::select('chapter_id', 'chapter_title', 'chapter_details', 'chapter_slug')->get();

        foreach ($chapters as $chapter) {
            $chapterTitle = trim($chapter->chapter_title);

            $data[$chapterTitle] = [
                'chapter_details' => trim($chapter->chapter_details),
                'chapter_slug' => trim($chapter->chapter_slug),
                'words' => []
            ];

            $words = ZWord::where('chapter_id', $chapter->chapter_id)
                ->select('word_id', 'word_title', 'word_slug')
                ->get();

            foreach ($words as $word) {
                $wordTitle = trim($word->word_title);

                $data[$chapterTitle]['words'][$wordTitle] = [
                    'word_slug' => trim($word->word_slug),
                    'dreams' => []
                ];

                $dreams = ZDream::where('word_dreams_id', $word->word_id)
                    ->select('dream_title', 'dreams_meaning', 'dream_slug')
                    ->get();

                foreach ($dreams as $dream) {
                    $data[$chapterTitle]['words'][$wordTitle]['dreams'][] = [
                        'dream_title' => trim($dream->dream_title),
                        'dream_slug' => trim($dream->dream_slug),
                        'meaning' => trim($dream->dreams_meaning),
                    ];
                }
            }
        }

        return view('alhodhod_frontend.layouts.dreams', compact('data'));
    }
}
