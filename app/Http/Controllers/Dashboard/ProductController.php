<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category','store'])->paginate();

        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tags = implode(',',$product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(Product::rules());

        $old_image = $product->image ;

        $data = $request->except(['image','tags']);

        $new_image = $this->uploadImage($request);
        if ($new_image)
        {
            $data['image'] = $new_image;
        }
        $product->update($data);

        if ($old_image && $new_image)
        {
            Storage::disk('public')->delete($old_image);
        }

        $tags = json_decode($request->post('tags')) ;

        $tag_ids = [];

        $saved_tags = Tag::all();

        foreach ($tags as $item){
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug',$slug)->first();
            if (!$tag)
            {
               $tag =  Tag::create([
                   'name' => $item->value,
                   'slug' => $slug
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);


        return redirect()->route('dashboard.products.index')->with('success','Product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image'))
        {
            return null;
        }
        $file = $request->file('image');
        $path = $file->store('products','public');

        return $path;

    }
}
