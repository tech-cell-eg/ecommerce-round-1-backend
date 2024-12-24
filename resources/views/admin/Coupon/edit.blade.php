@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Coupon </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update Coupon</h4>
                        <form action="{{route('coupons.update',$coupon)}}" class="forms-sample" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label> Coupon Code</label>
                                <input type="text" class="form-control mb-3" name="code" placeholder="Code" value="{{ $coupon->code }}">
                                @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Discount Value</label>
                                <input type="number" class="form-control mb-3" name="discount_value" placeholder="discount value" value="{{$coupon->discount_value }}">
                                @error('discount_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectGender">Discount Type</label>
                                <select class="form-select mb-3" id="exampleSelectGender" name="discount_type">
                                    <option  value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="percent" {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}>Percent</option>
                                    
                                </select>
                                @error('discount_type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label> Max Usage</label>
                                <input class="form-control mb-3" type="number" name="max_usage" value="{{ $coupon->max_usage }}">
                                @error('max_usage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label> Current Usage</label>
                                <input class="form-control mb-3" type="number" name="current_usage" value="{{ $coupon->current_usage }}">
                                @error('current_usage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputCity1">Expiry Date</label>
                                <input type="date" class="form-control mb-3"  placeholder="expiry date" name="expiry_date" value="{{ $coupon->expiry_date }}">
                                @error('expiry_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('coupons.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection