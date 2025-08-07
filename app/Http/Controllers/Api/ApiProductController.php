<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function index()
    {
        // Logic to return a list of products
        $products = Category::with('products')->get();
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }
        return response()->json($products);
    }

    public function show($id)
    {
        // Logic to return a single product by ID
        $product = Category::with('products')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    // Additional methods for create, update, delete can be added here
    public function store(Request $request)
    {
        // Logic to create a new product
        $data = $request->all();

        //Validate the request data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Xử lý hình ảnh
        if ($request->hasFile('image')) {
            //Lấy đường dẫn và lưu hình ảnh vào thư mục images trong storage
            $path = $request->file('image')->store('images');
            $data['image'] = $path;
        }
        // Create the product
        $data['image'] = $data['image'] ?? '';
        $product = Product::create($data);
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }
}
