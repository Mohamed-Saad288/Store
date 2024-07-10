

<div class="form-group">
    <x-form.label for="name" label="Product Name" />
    <x-form.input  name="name"  :value="$product->name"   />
</div>
<div class="form-group">
    <x-form.label  label="Categories" />
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach(\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id' , $product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <x-form.label for="description" label="Description" />
    <x-form.textarea  name="description"  :value="$product->description"   />
</div>
<div class="form-group">
    <x-form.label label="Image" />
    <x-form.input type="file"  name="image"  :value="$product->image" accept="image/*"   />
    <img src="{{ asset($product->image ? 'storage/' . $product->image: '') }}" height="60">
</div>
<div class="form-group">
    <x-form.label for="price" label="Price" />
    <x-form.input  name="price"  :value="$product->price"   />
</div>
<div class="form-group">
    <x-form.label for="compare_price" label="Compare Price" />
    <x-form.input  name="compare_price"  :value="$product->compare_price"   />
</div>
<div class="form-group">
    <x-form.label for="tags" label="Tags" />
    <x-form.input  name="tags"   :value="$tags" />
</div>
<div class="form-group">
    <x-form.radio name="status" :checked="$product->status" :options="['active' =>  'Active', 'archived' => 'Archived', 'draft' => 'Draft' ]"   />
</div>
<button type="submit" class="btn btn-primary mt-2">{{ $button_label ?? "Save" }}</button>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    <script>

        var input = document.querySelector('input[name=tags]');

        new Tagify(input)
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush
