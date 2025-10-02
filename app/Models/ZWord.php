<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZWord extends Model
{
    protected $table = 'z_words';

    /**
     * Get the language of the word by its slug.
     *
     * @param string $slug
     * @return string|null
     */
    public static function getLangBySlug(string $slug)
    {
        return static::where('word_slug', $slug)->value('lang');
    }
}
