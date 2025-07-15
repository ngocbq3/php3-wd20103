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
        $products = DB
        return $products;
    }
}
