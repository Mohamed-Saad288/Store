
@if($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occurred</h3>
        <ul>
            @foreach($errors->all() as  $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <x-form.label for="name" label="Category Name" />
    <x-form.input  name="name" type="text" :vlaue="$category->name"   />
</div>
<div class="form-group">
    <x-form.label label="Category Parent" />
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Categories</option>
        @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @selected( old('parent_id' , $category->parent_id) == $parent->id) >{{ $parent->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <x-form.label label="Description" />
    <x-form.textarea name="description"  :value="$category->description" />
</div>
<div class="form-group">
    <x-form.label label="Image" />
    <input type="file" name="image" class="form-control">
    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active' , 'archived' => 'Archived']" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label }}</button>
</div>
