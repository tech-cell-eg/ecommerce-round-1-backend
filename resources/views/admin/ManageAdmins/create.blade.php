@extends('layouts.dashboard')
@section('content')


<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Create Admins </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Create Admins</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('admins.store')}}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="name" placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" value="{{ old('email') }}">
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
                                <select name="role_id" required class="form-select mb-3">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="permissions">Assign Permissions:</label>
                                <select name="permissions[]" id="permissions" class="form-control">
                                    @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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
                        </form>


                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection