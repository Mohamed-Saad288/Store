@extends('layouts.dashboard')


@section('title','Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="mb-5 ">
    <a class="btn btn-small btn-outline-primary" href="{{ route('dashboard.categories.create') }}">New Category</a>
    <a class="btn btn-small btn-outline-danger " href="{{ route('dashboard.categories.trash') }}">Trash</a>
</div>

<x-alert type="success"/>
<x-alert type="info"/>

<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control mx-2" >
        <option value="" >All</option>
        <option value="active" @selected(request('status') == 'active') >Active</option>
        <option value="archived" @selected(request('status') == 'archived') >Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>

</form>

<table class="table">
    <thead>
    <tr>
        <th>Image</th>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Status</th>
        <th>Products *</th>
        <th>Created At</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"> </td>
            <td>{{ $category->id }}</td>
            <td><a href="{{ route('dashboard.categories.show',$category->id) }}"> {{ $category->name }}</a></td>
            <td>{{ $category->parent_name }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->products_count }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.categories.edit' , $category->id) }}" class="btn btn-sm btn-outline-success" >Edit</a>
            </td>
            <td>
                <form action="{{ route('dashboard.categories.destroy' , $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9">No Categories defined</td>
        </tr>
    @endforelse
    </tbody>
</table>

    {{ $categories->withQueryString()->links() }}
@endsection
