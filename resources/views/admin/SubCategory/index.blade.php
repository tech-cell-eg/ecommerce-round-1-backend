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
                            <h4 class="card-title">All Sub Categories</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Name </th>
                                            <th> Category </th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td class="py-1">
                                                {{$subcategory->id}}
                                            </td>
                                            <td> {{$subcategory->name}}</td>
                                            <td>{{$subcategory->category->name}}</td>
                                            <td>
                                                @can('category-edit')
                                            <th><a href="{{ route('subCategory.edit', [$subcategory->id]) }}" class="btn btn-primary btn-sm">Update</a></th>
                                            @endcan
                                            <th>
                                                @can('category-delete')
                                                <form action="{{route('subCategory.destroy',[$subcategory->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure you want to delete this Sub Category?');">Delete</button>
                                                </form>
                                                @endcan
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
                        {{ $subcategories->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection