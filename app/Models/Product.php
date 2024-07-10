<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'store_id',
        'price',
        'compare_price',
        'image',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope('store',function (Builder $builder){
           $user = Auth::user();
           if ($user->store_id)
           {
               $builder->where('store_id','=',$user->store_id);
           }
        });
    }

    public static function rules()
    {
        return [
            'name' => ['required','string','min:3','max:255'],
            'category_id' => ['nullable','exists:categories,id'],
            'image' => ['image'],
            'price' => ['required','numeric'],
            'compare_price' => ['nullable','numeric'],
            'status' => ['required','in:active,archived,draft']
        ];
    }

    public function category()
    {
       return $this->belongsTo(Category::class)
           ->withDefault();
    }
    public function store()
    {
      return  $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id','id','id');
    }
}
