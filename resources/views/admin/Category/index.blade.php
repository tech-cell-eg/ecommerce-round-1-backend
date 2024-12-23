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
                                            <th> Sub Categories </th>
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
                                                @if (isset($category->sub_categories) && count($category->sub_categories) > 0)
                                                <ul>
                                                    @foreach ($category->sub_categories as $subCategory)
                                                    <li>{{ $subCategory['name'] }}</li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                No Sub Categories
                                                @endif
                                            </td>
                                            <td>

                                            <th><a href="{{route('category.edit',[$category->id])}}" class="badge badge-primary">Update</a></th>
                                            <th>
                                                <form action="{{route('category.destroy',[$category->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-danger">Delete</button>
                                                </form>
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