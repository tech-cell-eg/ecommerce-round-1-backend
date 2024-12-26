@extends('layouts.dashboard')
@section('content')
<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Roles and Permissions</h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Manage Permissions</h4>

                    
                        <form action="{{ route('permissions.store') }}" method="POST" class="forms-sample">
                            @csrf
                            <h2>Add New Permission</h2>
                            <input type="text" name="permission_name" placeholder="Permission Name" required class="form-control mb-3">
                            <button type="submit" class="btn btn-primary me-2">Add Permission</button>
                        </form>

                

                        </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection
