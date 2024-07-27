<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasApiTokens , HasFactory , Notifiable;

    protected $fillable = [
        'name' , 'email', 'password' , 'username','phone_number' , 'status','super_admin'
    ];
}
