@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Category </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Update Category</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('subCategory.update',$subCategory->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label> Sub Category Name</label>
                                <input type="text" class="form-control mb-3" name="name" placeholder="Name" value="{{$subCategory->name}}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for=""> Category </label>
                                <select name="category_id" class="form-control mb-3">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ $category->id == $subCategory->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('subCategory.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection