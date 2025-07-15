@extends('master')
@section('title')
    Trang chủ
@endsection
@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <a href="{{ route('product.show', $product->id) }}">
                    <h3>{{ $product->name }}</h3>
                </a>
                <div>Price: {{ $product->price }}</div>
                <hr>
            </div>
        @endforeach
    </div>
@endsection
