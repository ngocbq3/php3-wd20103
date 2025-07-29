@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    @session('success')
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endsession
    <div class="container wd-80">
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Category Name</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" @selected($cate->id == $product->category_id)>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Price</label>
                <input type="number" class="form-control" name="price" step="0.1" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Quantity</label>
                <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Image</label> <br>
                <img src="{{ Storage::URL($product->image) }}" width="90" alt=""> <br>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Description</label>
                <textarea name="description" id="" rows="10" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">List Product</a>
            </div>
        </form>
    </div>
@endsection
