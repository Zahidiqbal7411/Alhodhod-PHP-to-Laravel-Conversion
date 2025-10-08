<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'z_words';
    protected $primaryKey = 'word_id';
    public $timestamps = false;

    
    public function chapter(){
        return $this->belongsTo(Chapter::class , 'chapter_id' , 'chapter_id');
    }
    public function dreams(){
         return $this->hasMany(Dream::class, 'word_dreams_id', 'word_id');
    }
}
