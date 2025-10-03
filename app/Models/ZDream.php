<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZDream extends Model
{
    protected $table = 'z_dreams';
    protected $fillable = ['dream_title', 'dreams_meaning', 'dream_slug', 'word_dreams_id'];
}
