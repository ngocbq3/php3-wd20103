<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        //Lấy ra tất cả sản phẩm
        $products = DB::table('products')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        //Lấy sản phẩm theo điều kiện
        $products = DB::table('products')
            ->where("price", ">", 90)
            ->get();

        //Lấy sản phẩm cho trang chủ
        $products = DB::table('products')
            ->orderBy('price', 'desc')
            ->limit(8)
            ->get();
        //Lấy danh sách categories
        $categories = DB::table('categories')
            ->get();

        return view('index', compact('products', 'categories'));
    }

    public function show($id)
    {
        //Lấy ra 1 sản phẩm theo id
        $product = DB::table('products')
            ->where('id', '=', $id)
            ->first();

        return view('detail', compact('product'));
    }
}
