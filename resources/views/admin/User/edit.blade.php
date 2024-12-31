@extends('layouts.dashboard')
@section('content')


<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update User </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update User</h4>
                            <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('users.update',$user)}}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="first_name"  placeholder="First Name" value="{{ $user->first_name }}">
                                    @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="last_name"  placeholder="Last Name" value="{{ $user->last_name }}">
                                    @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" value="{{$user->email}}">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                            </form>

                            </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection