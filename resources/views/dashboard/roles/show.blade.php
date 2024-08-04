@extends('layouts.dashboard')


@section('title','Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Products</li>

@endsection

@section('content')

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
            <th>ID</th>
            <th>Product Name</th>
            <th>Product Store</th>
            <th>Product Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
        </thead>
        <tbody>
        @php
         $products = $category->products()->with('store')->latest()->paginate(5);
        @endphp
        @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->store->name }}</td>
                <td>{{ $product->status }}</td>
                <td>{{$product->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No products defined</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>

@endsection
