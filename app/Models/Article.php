<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'lang',
        'article_title',
        'article_slug',
        'article_image',
        'content',
        'show_on_home_page',
        'menu_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = true;

    /**
     * Relationship: Article belongs to Menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
