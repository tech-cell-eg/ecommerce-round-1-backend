@extends('layouts.dashboard')
@section('content')


<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Admin</h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update Admin</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('admins.update',$admin)}}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="name" placeholder="Name" value="{{ $admin->name }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" value="{{ $admin->email }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role_id" required  class="form-select mb-3">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id ==$admin->role_id_id  ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Image upload</label>
                                <input type="file" name="image" class="form-control mb-3">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('admins.index') }}" class="btn btn-light">Cancel</a>

                        </form>

                      
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection