<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZChapter extends Model
{
    protected $table = 'z_chapters';

    /**
     * Get the language of the chapter by its slug.
     *
     * @param string $slug
     * @return string|null
     */
    public static function getLangBySlug(string $slug)
    {
        return static::where('chapter_slug', $slug)->value('lang');
    }
}
