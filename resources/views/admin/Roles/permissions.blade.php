@extends('layouts.dashboard')
@section('content')

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <div class="content-wrapper">






            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card mt-5">
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <!-- Display flash message -->
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">All Permissions</h4>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> Id </th>
                                                <th>Permission Name </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
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
            <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{ $permissions->links() }}
                    </ul>
                </nav>
        </div>
    </div>




</div>
</div>



@endsection