@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Blog </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update Blog</h4>
                        <form action="{{route('blogs.update',$blog)}}" class="forms-sample" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label> Blog Title</label>
                                <input type="text" class="form-control mb-3" name="title" placeholder="Title" value="{{ $blog->title }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label> Blog content</label>
                                <input type="text" class="form-control mb-3" name="content" placeholder="content" value="{{ $blog->content }}">
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label> Blog Slug</label>
                                <input type="text" class="form-control mb-3" name="slug" placeholder="slug" value="{{ $blog->slug }}">
                                @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectGender">Status</label>
                                <select class="form-select mb-3" id="exampleSelectGender" name="status">
                                    <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ $blog->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for=""> Category </label>
                                <select name="category" class="form-control mb-3">
                                    @foreach($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for=""> Author </label>
                                <select name="author_id" class="form-control mb-3">
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" name="tags" id="tags" class="form-control" value="{{ $blog->tags }}" placeholder="Comma-separated tags">
                                @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label for="exampleSelectGender">Featured</label>
                                <select class="form-select mb-3" id="exampleSelectGender" name="is_featured">
                                    <option value="1" {{ $blog->is_featured == 1 ? 'selected' : '' }}>Featured</option>
                                    <option value="0" {{ $blog->is_featured == 0 ? 'selected' : '' }}>Not Featured</option>
                                </select>
                                @error('is_featured')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Featured Image -->
                            <div class="form-group">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control">
                                @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('blogs.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection