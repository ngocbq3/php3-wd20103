@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="container wd-80">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Category Name</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}">
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Price</label>
                <input type="number" class="form-control" name="price" step="0.1">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Quantity</label>
                <input type="number" class="form-control" name="quantity">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Description</label>
                <textarea name="description" id="" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">List Product</a>
            </div>
        </form>
    </div>
@endsection
