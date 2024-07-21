<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id','first_name','last_name','country','phone_number','city',
        'postal_code','email','type','street_address','state'
    ];

    public $timestamps = false;

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCountryNameAttribute()
    {
        return Countries::getName($this->country);
    }
}
