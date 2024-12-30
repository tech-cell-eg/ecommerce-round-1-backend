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
                            <h4 class="card-title mb-5"> {{$product->name}}</h4>
                            <div class="card mb-5" style="width: 18rem;">
                                <img src="{{asset('storage/'.$product->image)}}" alt="image" />
                            </div>
                            <div class="card-body">
                                <h6>Description: </h6>
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                            <div class="table-responsive mb-5">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Field </th>
                                            <th> Value </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Product ID </td>
                                            <td> {{ $product->id }} </td>
                                        </tr>
                                        <tr>
                                            <td> Product Name </td>
                                            <td> {{ $product->name }} </td>
                                        </tr>
                                        <tr>
                                            <td> Product Price </td>
                                            <td> {{ $product->price }} </td>
                                        </tr>
                                        <tr>
                                            <td> Product Old Price </td>
                                            <td> {{ $product->compare_price }} </td>
                                        </tr>
                                        <tr>
                                            <td> Product Rate </td>
                                            <td> {{ $product->rating }} </td>
                                        </tr>
                                        <tr>
                                            <td>Product Color </td>
                                            <td> {{ $product->color }} </td>
                                        </tr>
                                        <tr>
                                            <td> Product Size </td>
                                            <td> {{ $product->size }} </td>
                                        </tr>
                                        <tr>
                                            <td> Category </td>
                                            <td> ${{ $product->category->name }} </td>
                                        </tr>


                                    </tbody>
                                </table>




                            </div>


                            <a href="{{ route('products.index') }}" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection