<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory; 

     // ✅ Tell Laravel to use the correct table
    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'profile_image',
        'email',
        'password',
        'username',
        'user_status',
        'region_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
