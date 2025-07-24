<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //lấy toàn bộ sản phẩm
        // $products = Product::all();

        //Lấy sản phẩm có thông tin của category
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->except('image');
        //thêm image vào data
        $data['image'] = "";

        //Xử lý hình ảnh
        if ($request->hasFile('image')) {
            //Lấy đường dẫn và lưu hình ảnh vào thư mục images trong storage
            $path = $request->file('image')->store('images');
            $data['image'] = $path;
        }
        Product::query()->create($data);
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = Product::query()->find($id);
        if ($product) {
            $product->delete();
        }
        return redirect()->route('admin.products.index');
    }
}
