@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Orders </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update Orders</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('orders.update', $order)}}">
                            @csrf
                            @method('PATCH')
                            
                            <div class="form-group">
                                <label> Status</label>
                                <input type="text" class="form-control mb-3"  name="status" value="{{ $order->status }}">
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="text" class="form-control mb-3" name="delivery_date" value="{{ $order->delivery_date }}">
                                @error('delivery_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label> Review</label>
                                <textarea name="review" class="form-control mb-3">{{ $order->review }}</textarea>
                                @error('review')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        


                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection