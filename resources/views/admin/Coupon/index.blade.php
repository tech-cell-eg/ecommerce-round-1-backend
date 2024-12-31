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
                            <h4 class="card-title">All Coupons</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Max Usage</th>
                                            <th>Current Usage</th>
                                            <th>Expiry Date</th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ ucfirst($coupon->discount_type) }}</td>
                                        <td>{{ $coupon->discount_value }}</td>
                                        <td>{{ $coupon->max_usage }}</td>
                                        <td>{{ $coupon->current_usage }}</td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            @can('coupons-edit')
                                        <th><a href="{{route('coupons.edit', $coupon)}}" class="btn btn-primary btn-sm">Update</a></th>
                                        @endcan
                                        <th>
                                            @can('coupons-delete')
                                            <form action="{{route('coupons.destroy', $coupon)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Product?');">Delete</button>
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
                        {{ $coupons->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


@endsection