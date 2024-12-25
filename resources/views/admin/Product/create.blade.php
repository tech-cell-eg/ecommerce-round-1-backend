@extends('layouts.dashboard')
@section('content')




<!-- parti  al -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Add Product </h3>

        </div>
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Add Product</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('products.store')}}">
                            @csrf
                            <div class="form-group">
                                <label> Product Name</label>
                                <input type="text" class="form-control mb-3" name="name" placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label> Product Price </label>
                                <input type="number" class="form-control mb-3" name="price" placeholder="Price" value="{{ old('price') }}">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Product Old Price</label>
                                <input type="number" class="form-control mb-3" name="compare_price" placeholder="Old Price" value="{{ old('compare_price') }}">
                                @error('compare_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Size</label>
                                <select class="form-select mb-3" id="exampleSelectGender" name="size">
                                    <option  value="S" {{ old('size') == 'S' ? 'selected' : '' }}>Small</option>
                                    <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>Medium</option>
                                    <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>Large</option>
                                    <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>X Large</option>
                                </select>
                                @error('size')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label> Product Color</label>
                                <input class="form-control mb-3" type="color" name="color" value="{{ old('color') }}">
                                @error('color')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image upload</label>
                                <input type="file" name="image" class="form-control mb-3">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Rating</label>
                                <input type="number" class="form-control mb-3" id="exampleInputCity1" placeholder="Rating" name="rating" value="{{ old('rating') }}>
                                @error('rating')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectGender">Featured</label>
                                <select class="form-select mb-3" id="exampleSelectGender" name="featured">
                                    <option value="1" {{ old('featured') == 1 ? 'selected' : '' }}>Featured</option>
                                    <option value="0" {{ old('featured') == 0 ? 'selected' : '' }}>Not Featured</option>
                                </select>
                                @error('featured')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for=""> Category </label>
                                <select name="category_id" class="form-control mb-3">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description</label>
                                <input type="text" class="form-control mb-3" id="exampleTextarea1" rows="4" name="description"  value="{{ old('description') }}">
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection