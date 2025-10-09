<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    protected $table = 'z_dreams';
    protected $primaryKey = 'dream_id';
    public $timestamps = false;

    protected $fillable = [
        'dream_title',
        'dreams_meaning',
        'dream_slug',
        'word_dreams_id',
        'chapter_dreams_id',
        'lang'
    ];

  
    
    public function Chapter(){
        return $this->belongsTo(Chapter::class , 'chapter_dreams_id' , 'chapter_id');

    }
    public function Word(){
        return $this->belongsTo(Word::class , 'word_dreams_id' , 'word_id');
    }
public function scopeLang($query, $lang)
{
    return $query->where('lang', $lang);
}

}