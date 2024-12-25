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
                            <h4 class="card-title">All Products</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Name </th>
                                            <th> image </th>
                                            <th> Description </th>
                                            <th> Price </th>
                                            <th> Old Price </th>
                                            <th> rating </th>
                                            <th> Color </th>
                                            <th> Size </th>
                                            <th> category</th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td class="py-1">
                                                {{$product->id}}
                                            </td>
                                            <td> {{$product->name}}</td>
                                            <td>
                                                <img src="{{asset('storage/'.$product->image)}}" alt="image" />
                                            </td>
                                            <td> {{$product->description}} </td>
                                            <td> $ {{$product->price}} </td>
                                            <td> $ {{$product->compare_price}} </td>
                                            <td> {{$product->rating}} </td>
                                            <td> {{$product->color}} </td>
                                            <td> {{$product->size}} </td>
                                            <td> {{$product->category->name}} </td>
                                            <td>
                                            <th><a href="{{route('products.edit',[$product->id])}}" class="btn btn-primary btn-sm">Update</a></th>
                                            <th>
                                                <form action="{{route('products.destroy',[$product->id])}}" method="post">
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


<nav aria-label="Page navigation">
    <ul class="pagination">

        {{ $products->withQueryString()->links() }}
    </ul>
</nav>

@endsection