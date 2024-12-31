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
                            <h4 class="card-title">All Users</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th>First Name </th>
                                            <th> Last Name </th>
                                            <th> Email </th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="py-1">
                                                {{$user->id}}
                                            </td>
                                            <td> {{$user->first_name}}</td>
                                            <td> {{$user->last_name}} </td>
                                            <td> {{$user->email}} </td>
                                            <td>
                                                @can('user-edit')
                                            <th><a href="{{route('users.edit',[$user->id])}}" class="btn btn-primary btn-sm">Update</a></th>
                                                @endcan
                                            <th>
                                            @can('user-delete')
                                                <form action="{{route('users.destroy',[$user->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure you want to delete this Product?');">Delete</button>
                                                </form>
                                                @endcan
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
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{ $users->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


@endsection