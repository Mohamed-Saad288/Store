@extends('layouts.dashboard')


@section('title','Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <x-alert type="success" />
    <form action="{{ route('dashboard.profile.update') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.label label="First Name"  />
                <x-form.input name="first_name" :value="$user->profile->first_name"/>
            </div>
            <div class="col-md-6">
                <x-form.label label="Last Name" />
                <x-form.input name="last_name" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.label label="Birthday" />
                <x-form.input type="date" name="birthday" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.label label="Gender" />
                <x-form.radio name="gender" :checked="$user->profile->gender"  :options="['male' => 'Male', 'female' => 'Female']" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.label label="Street Address" />
                <x-form.input name="street_address" :value="$user->profile->street_address" />
            </div>
            <div class="col-md-4">
                <x-form.label label="City" />
                <x-form.input name="city"  :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <x-form.label label="State" />
                <x-form.input name="state"  :value="$user->profile->state" />
            </div>
        </div>
        <div class="form-row">
                <div class="col-md-4">
                    <x-form.label label="Postal Code" />
                    <x-form.input name="postal_code" :value="$user->profile->postal_code" />
                </div>
                <div class="col-md-4">
                    <x-form.label label="Country" />
                    <x-form.select name="country" :options="$countries" :selected="$user->profile->country" />
                </div>
                <div class="col-md-4">
                    <x-form.label label="locale" />
                    <x-form.select name="country" :options="$locales" :selected="$user->profile->locale" />
                </div>
    </div>
        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
@endsection
