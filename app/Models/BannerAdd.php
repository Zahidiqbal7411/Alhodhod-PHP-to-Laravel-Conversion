<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerAdd extends Model
{
    protected $table = 'banner_ads';
    public $timestamps = false;

    protected $fillable = [
        'ad_url',
        'ad_text',
        'ad_link',
        'ad_type',
        'ar',
        'ad_status'
    ];
}