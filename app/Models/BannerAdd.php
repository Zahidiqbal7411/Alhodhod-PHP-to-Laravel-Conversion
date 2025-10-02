<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerAdd extends Model
{
    protected $table = 'banner_ads';

    protected $fillable = [
        'ad_type', 'ad_url', 'ad_text', 'ad_link',
        'en', 'fr', 'ar',
        'ad_clicks', 'ad_status',
        'created_at', 'updated_at',
    ];
}
