@extends('layouts.dashboard')


@section('title','Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Role</li>
    <li class="breadcrumb-item active">Edit Role</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update',$role->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
            @include('dashboard.roles._form',['button_label' => 'Update'])
    </form>
@endsection
