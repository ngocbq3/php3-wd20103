@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">
                        <a href="" class="btn btn-primary">Create</a>
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ $product->image }}" width="100" alt="">
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
