<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZDream extends Model
{
    protected $table = 'z_dreams';

    /**
     * Get the language of the dream by its slug.
     *
     * @param string $slug
     * @return string|null
     */
    public static function getLangBySlug(string $slug)
    {
        return static::where('dream_slug', $slug)->value('lang');
    }
}
