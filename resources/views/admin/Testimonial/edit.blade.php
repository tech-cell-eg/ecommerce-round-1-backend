@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Testimonial </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update Testimonial</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('testimonials.update', $testimonial)}}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label> Testimonial Text</label>
                                <textarea name="text" id="text" class="form-control mb-3" required>{{ $testimonial->text }}</textarea>
                                @error('text')
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