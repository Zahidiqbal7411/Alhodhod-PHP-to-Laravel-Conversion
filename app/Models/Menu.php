<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{


    protected $guarded = [];
    

    public function page(){
        return $this->belongsTo(Page::class); 
    }


    //menus or articla kar relationship   ek menus k bhaot saray article hn saktay hian 
    
    public function article(){
        return $this->hasMany(Article::class);
    }
}
