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
                            <h4 class="card-title">All Blogs</h4>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Id </th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th colspan="2"> Actions </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->id }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->author->first_name }}</td>
                                            <td>{{ ucfirst($blog->status) }}</td>
                                            <td>{{ $blog->category }}</td>
                                            <td>
                                            <td>
                                                @can('blog-list')
                                            <th><a href="{{route('blogs.show',[$blog->id])}}" class="btn btn-primary btn-sm">Show</a></th>
                                            @endcan
                                            @can('blog-edit')
                                            <th><a href="{{route('blogs.edit',[$blog->id])}}" class="btn btn-primary btn-sm">Update</a></th>
                                            @endcan
                                            @can('blog-delete')
                                            <th>
                                                <form action="{{route('blogs.destroy',[$blog->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Product?');">Delete</button>
                                                </form>
                                            </th>
                                            @endcan
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">No blogs found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{ $blogs->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>



@endsection