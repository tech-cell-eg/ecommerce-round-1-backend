@extends('layouts.dashboard')
@section('content')

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->

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
                            <h4 class="card-title">All Products</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Name </th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td class="py-1">
                                                {{$category->id}}
                                            </td>
                                            <td> {{$category->name}}</td>
                                            
                                            
                                            <td>
                                            @can('category-edit')
                                            <th><a href="{{route('category.edit',[$category->id])}}" class="btn btn-primary btn-sm">Update</a></th>
                                            @endcan

                                            @can('category-delete')

                                            <th>
                                                <form action="{{route('category.destroy',[$category->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure you want to delete this Category?');">Delete</button>
                                                </form>
                                                </td>
                                                    @endcan
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
                        {{ $categories->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection