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
                            <div class="table-responsive">
                                
                                <table class="table table-striped mb-5">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th> Name </th>
                                            <th> Price </th>
                                            <th> Old Price </th>
                                            <th> rating </th>
                                            <th> Color </th>
                                            <th> Size </th>
                                            <th> category</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1">
                                                {{$product->id}}
                                            </td>
                                            <td> {{$product->name}}</td>
                                            <td>
                                            </td>
                                            <td> $ {{$product->price}} </td>
                                            <td> $ {{$product->compare_price}} </td>
                                            <td> {{$product->rating}} </td>
                                            <td> {{$product->color}} </td>
                                            <td> {{$product->size}} </td>
                                            <td> {{$product->category->name}} </td>


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