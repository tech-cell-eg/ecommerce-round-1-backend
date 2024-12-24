@extends('layouts.dashboard')


@section('content')
    <h1>Testimonial Details</h1>
    <h3>{{ $testimonial->text }}</h3>
    <!-- Include links to edit or delete -->
    <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection