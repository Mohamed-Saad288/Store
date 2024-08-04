<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasApiTokens , HasFactory , Notifiable ;

    protected $fillable = [
        'name' , 'email', 'password' , 'username','phone_number' , 'status','super_admin'
    ];

    public function roles()
    {
        return  $this->belongsToMany(Role::class,'role_user','admin_id','role_id','id','id');
    }
    public function hasAbility($ability)
    {
        return $this->roles()->whereHas('abilities', function ($query) use ($ability){
            $query->where('ability',$ability)
                ->where('type','=','allow');
        })->exists();


    }
}
