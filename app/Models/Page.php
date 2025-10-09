<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page_name',
        'page_link',
        'page_en',
        'page_fr',
        'page_ar'
    ];

    // Define if you have menus table linked
    public function menus()
    {
        return $this->hasMany(Menu::class, 'page_id');
    }

    public function getContentByLanguage($lang)
    {
        return match ($lang) {
            'fr' => $this->page_fr,
            'ar' => $this->page_ar,
            default => $this->page_en,
        };
    }
    // app/Models/Page.php

public function getLocalizedNameAttribute()
{
    $lang = get_active_language(); // or app()->getLocale()
    return $this->{"page_{$lang}"} ?? $this->page_name;
}

}
