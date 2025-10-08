<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'z_chapters';
    protected $primaryKey = 'chapter_id';
    public $timestamps = false;

    protected $fillable = [
        'chapter_title',
        'chapter_details',
        'chapter_slug',
        'lang'
    ];

    public function words(){
        return $this->hasMany(Word::class , 'chapter_id' , 'chapter_id');
    }
  
    public function dreams(){
        return $this->hasMany(Dream::class , 'chapter_dreams_id' , 'chapter_id');
    }
  
}