<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
           if ($user && $user->store_id)
           {
               $builder->where('store_id','=',$user->store_id);
           }
           static::creating(function (Product $product){
               $product->slug = Str::slug($product->name);
           });
        });
    }

    public static function rules()
    {
        return [
            'name' => ['required','string','min:3','max:255'],
            'category_id' => ['nullable','exists:categories,id'],
            'store_id' => ['required','exists:stores,id'],
            'image' => ['image'],
            'price' => ['required','numeric'],
            'compare_price' => ['nullable','numeric','gt:price'],
            'status' => ['nullable','in:active,archived,draft']
        ];
    }
    protected $hidden = ['created_at','updated_at','deleted_at','image'];

    protected $appends = ['image_url'];

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
    public function scopeActive(Builder $builder)
    {
        $builder->where('status','=','active');
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKnKnw0MtmVH5_-A-wrEh5OiTSL3lu_5MZZA&s';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;

        }
        return asset('storage/' . $this->image);

    }
    public function getSalePercentAttribute()
    {
        if (!$this->compare_price)
        {
            return 0 ;
        }
        return  round(100 - (100 * $this->price / $this->compare_price),1 );
    }

    public function scopeFilter(Builder $builder , $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null ,
            'tag_id' => null,
            'status' => 'active'
        ],$filters);

        $builder->when($options['status'],function ($builder , $value){
                $builder->where('status',$value);
        });

        $builder->when($options['store_id'],function ($builder , $value){
            $builder->where('store_id' , $value);
        });
        $builder->when($options['category_id'],function ($builder , $value){
            $builder->where('category_id' , $value);
        });
        $builder->when($options['tag_id'],function ($builder , $value){


            $builder->whereExists(function ($builder) use ($value) {
               $builder->select(1)
                    ->from('product_tag')
                   ->whereRaw('product_id = products.id')
                   ->where('tag_id',$value);
            });


            //$builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id=? )',[$value]);

            //$builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id=? AND product_id = products.id )',[$value]);

            //   $builder->has('tags'); // all products has tags

          //  $builder->dosentHas('tags'); // all products dosent has tags


//            $builder->whereHas('tags',function ($builder) use($value){
//                $builder->where('id',$value);
//            });

        });
    }
}
