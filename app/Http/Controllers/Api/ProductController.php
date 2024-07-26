<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['category:id,name','store:id,name','tags:id,name'])
            ->filter($request->query())
            ->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Product::rules());

        $product = Product::create($request->all());

        return Response::json($product,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
        //return $product->load('category:id,name','store:id,name','tags:id,name');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => ['sometimes|required','string','min:3','max:255'],
            'category_id' => ['nullable','exists:categories,id'],
            'store_id' => ['sometimes','required','exists:stores,id'],
            'image' => ['image'],
            'price' => ['sometimes','required','numeric'],
            'compare_price' => ['nullable','numeric','gt:price'],
            'status' => ['nullable','in:active,archived,draft']
        ]);
        $product->update($request->all());

        return Response::json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);

        return [
            'message' => 'Product Deleted Successfully'
        ];
    }
}
