<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
//        ->onlyTrashed()  // Soft Deletes
//        ->withTrashed() // Soft Deletes
        ->filter(\request()->all())->paginate(2);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules(),[
            'name.required' => 'this field (:attribute) is required',
            'unique' => 'this field (:attribute) is already exists'
        ]);
        $request->merge([
        'slug' => Str::slug($request->name)
        ]);

        $data = $request->except('image');

         $data['image'] = $this->uploadImage($request);

        $category = Category::create($data);
        return redirect()->route('dashboard.categories.index')
            ->with('success' , 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        }catch (\Exception $e)
        {
            return redirect()->route('dashboard.categories.index')
                ->with('info','Record Not Found');

        }

        $parents = Category::where('id' , '<>' , $id)
            ->whereNull('parent_id')->get();



        return view('dashboard.categories.edit',compact(['category','parents']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);
        $old_image = $category->image ;
        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image)
        {
            $data['image'] = $new_image;
        }
        $category->update($data);

        if ($old_image && $new_image)
        {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')
            ->with('success' , 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $category =  Category::findOrFail($id);
         $category->delete();
//          if ($category->image)
//          {
//              Storage::disk('public')->delete($category->image);
//          }
        return redirect()->route('dashboard.categories.index')
            ->with('success' , 'Category Deleted Successfully');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image'))
        {
            return ;
        }
            $file = $request->file('image');
            $path = $file->store('categories','public');

            return $path;

    }
}
