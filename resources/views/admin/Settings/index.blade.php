@extends('layouts.dashboard')
@section('content')

<div class="container mt-4">
    <h1>Manage Settings</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-5">Add Category</h4>
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control mb-3"
                value="{{ $settings->where('key', 'email')->first()->value }}">
        </div>

        <div class="form-group mt-3">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control"
                value="{{ $settings->where('key', 'phone_number')->first()->value }}">
        </div>

        <div class="form-group mt-3">
            <label for="website_name">Website Name</label>
            <input type="text" id="website_name" name="website_name" class="form-control"
                value="{{ $settings->where('key', 'website_name')->first()->value }}">
        </div>

        <button type="submit" class="btn btn-primary mt-4">Update Settings</button>
    </form>
</div>
    </div>
</div>
    </div>
@endsection