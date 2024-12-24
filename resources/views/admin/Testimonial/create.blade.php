@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Create Testimonial </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Create Testimonial</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('testimonials.store')}}">
                            @csrf
                            <div class="form-group">
                                <label> Testimonial Text</label>
                                <textarea name="text" id="text" class="form-control mb-3" ></textarea>
                                @error('text')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""> User </label>
                                <select name="user_id" class="form-control mb-3">
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for=""> Product </label>
                                <select name="product_id" class="form-control mb-3">
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image upload</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Video Upload</label>
                                <input type="file" name="video" class="form-control">
                                @error('video')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('testimonials.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection