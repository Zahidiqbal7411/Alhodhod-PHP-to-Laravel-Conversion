<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'z_chapters';
    protected $primaryKey = 'chapter_id';
    public $timestamps = false;

    public function words()
    {
        return $this->hasMany(Word::class, 'chapter_id', 'chapter_id');
    }
}
