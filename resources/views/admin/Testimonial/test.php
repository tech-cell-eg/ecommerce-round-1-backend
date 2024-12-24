@extends('layouts.dashboard')

@section('content')
    <h1>Create Testimonial</h1>
    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Add fields for image, video, product_id, and text -->
        <div>
            <label for="text">Testimonial Text</label>
            <textarea name="text" id="text" required></textarea>
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <label for="video">Video</label>
            <input type="file" name="video" id="video">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection