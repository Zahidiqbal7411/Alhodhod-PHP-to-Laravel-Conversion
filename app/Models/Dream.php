<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    protected $table = 'z_dreams';
    protected $primaryKey = 'dream_id'; // Update this if your primary key is different
    public $timestamps = false;

    public function word()
    {
        return $this->belongsTo(Word::class, 'word_dreams_id', 'word_id');
    }
}
