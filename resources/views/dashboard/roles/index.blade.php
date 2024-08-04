@extends('layouts.dashboard')


@section('title','Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')
<div class="mb-5 ">
    <a class="btn btn-small btn-outline-primary" href="{{ route('dashboard.roles.create') }}">New Role</a>
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
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>

        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>

            <td>{{ $role->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.roles.edit' , $role->id) }}" class="btn btn-sm btn-outline-success" >Edit</a>
            </td>
            <td>
                <form action="{{ route('dashboard.roles.destroy' , $role->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No roles defined</td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection
