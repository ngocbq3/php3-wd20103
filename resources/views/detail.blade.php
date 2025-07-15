@extends('master')

@section('title')
    Chi tiết sản phẩm {{ $product->name }}
@endsection

@section('content')
    <div>
        <h2>{{ $product->name }}</h2>
        <div>
            Price: {{ $product->price }}
        </div>
        <div>
            <img src="{{ $product->image }}" width="300" alt="">
        </div>
        <div>
            {{ $product->description }}
        </div>
    </div>
@endsection
