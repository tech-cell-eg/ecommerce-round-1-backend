@extends('layouts.login')
@section('content')
<h4>Hello! let's get started</h4>
<h6 class="font-weight-light">Sign in to continue.</h6>
<form class="pt-3" method="POST" action="{{ route('admin.login') }}">

    @csrf
    <div class="form-group">
        <label for="email" :value="__('Email')">Email</label>
        <input type="email" class="form-control form-control-lg" name="email" :value="old('email')" required autofocus autocomplete="username">
    </div>


    <div class="form-group">
        <label for="password" :value="__('Password')">Password</label>
        <input type="password" class="form-control form-control-lg" id="password" class="block mt-1 w-full"
            name="password"
            required autocomplete="current-password">
    </div>
    <div class="mt-3">
        <button type="submit" name="submit" class="btn d-grid btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
    </div>


</form>
@endsection