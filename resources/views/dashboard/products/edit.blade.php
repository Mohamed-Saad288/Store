@extends('layouts.dashboard')




@section('title','products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">product</li>
    <li class="breadcrumb-item active">Edit product</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.update',$product->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.products._form',['button_label' => 'Update'])
    </form>
@endsection
