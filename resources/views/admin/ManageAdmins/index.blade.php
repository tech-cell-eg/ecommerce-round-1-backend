@extends('layouts.dashboard')
@section('content')

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <div class="content-wrapper">

            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card mt-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- Display flash message -->
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <h4 class="card-title">All Admins</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Role </th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td class="py-1">
                                                {{$admin->id}}
                                            </td>
                                            <td> {{$admin->name}}</td>
                                            <td> {{$admin->email}} </td>
                                            <td> {{ $admin->role->name ?? 'No Role' }}</td>
                                            <td>
                                            <th><a href="{{route('admins.edit',[$admin->id])}}" class="btn btn-primary btn-sm">Update</a></th>
                                            <th>
                                                <form action="{{route('admins.destroy',[$admin->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure you want to delete this Product?');">Delete</button>
                                                </form>
                                            </th>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection