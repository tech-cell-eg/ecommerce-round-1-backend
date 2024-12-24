@extends('layouts.dashboard')
@section('content')

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->

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
                            <h4 class="card-title">All Sub Categories</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Text</th>
                                            <th>Image</th>
                                            <th>Video</th>
                                            <th>User</th>
                                            <th>Product</th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $testimonial->id }}</td>
                                            <td>{{ $testimonial->text }}</td>
                                            <td>
                                                @if($testimonial->image)
                                                <img src="{{ asset('storage/'.$testimonial->image) }}" alt="Image" style="max-width: 100px;">
                                                @else
                                                No Image
                                                @endif
                                            </td>
                                            <td>
                                                @if($testimonial->video)
                                                <video width="100" controls>
                                                    <source src="{{ asset($testimonial->video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                @else
                                                No Video
                                                @endif
                                            </td>
                                            <td>{{ $testimonial->user->first_name}}</td>
                                            <td>{{ $testimonial->product->name }}</td>

                                            <td>
                                                <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-primary btn-sm">Edit</a>

                                                <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this testimonial?');">Delete</button>
                                                </form>
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
@endsection