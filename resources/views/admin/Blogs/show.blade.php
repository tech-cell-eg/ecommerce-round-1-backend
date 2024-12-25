@extends('layouts.dashboard')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="blog-post">
                    <!-- Blog Title -->
                    <h1 class="blog-title">{{ $blog->title }}</h1>

                    <!-- Author Info -->
                    <div class="author-info">
                        <p>By <strong>{{ $blog->author->first_name }}</strong></p>
                        <p>Published on {{ $blog->published_at }}</p>
                    </div>

                    <!-- Featured Image -->
                    @if($blog->featured_image)
                        <div class="featured-image">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid">
                        </div>
                    @endif

                    <!-- Blog Content -->
                    <div class="blog-content mt-3">
                        <p>{!! nl2br(e($blog->content)) !!}</p>
                    </div>

                    <!-- Tags and Category -->
                    <div class="tags-category mt-3">
                        <p><strong>Category:</strong> {{ $blog->category }}</p>
                        <p><strong>Tags:</strong> {{ $blog->tags }}</p>
                    </div>

                    <!-- Like and Comment Counts -->
                    <div class="like-comment-counts mt-3">
                        <p><strong>Likes:</strong> {{ $blog->like_count }}</p>
                        <p><strong>Comments:</strong> {{ $blog->comment_count }}</p>
                    </div>

                    <!-- Blog Status -->
                    <div class="blog-status mt-3">
                        <p><strong>Status:</strong> {{ ucfirst($blog->status) }}</p>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('blogs.index') }}" class="btn btn-primary">Back to Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
