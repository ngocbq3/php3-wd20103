<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

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

    //hiển thị form cập nhật
    public function edit($id)
    {
        //LẤY thông tin sản phẩm cần cập nhật
        $product = Product::find($id);
        //Lấy thông tin danh mục
        $categories = Category::all();
        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }
    //Phương cập nhật dữ liệu khi sửa
    public function update(UpdateProductRequest $request, $id)
    {
        //Lấy sản phẩm muốn cập nhật
        $product = Product::query()->findOrFail($id);
        //Lấy yêu cầu từ form edit
        $data = $request->validated();

        //Xử lý hình ảnh
        if ($request->hasFile('image')) {
            //Lấy đường dẫn và lưu hình ảnh vào thư mục images trong storage
            $path = $request->file('image')->store('images');
            $data['image'] = $path;
            //Xóa ảnh cũ
            if (Storage::fileExists($product->image)) {
                Storage::delete($product->image);
            }
        }
        //Cập nhật
        $product->update($data);

        return redirect()->back()->with('success', 'Cập nhật dữ liệu thành công');
    }
}
