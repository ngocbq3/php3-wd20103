<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn cần nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.min' => 'Tên tối thiểu phải 5 ký tự',
            'price.required' => 'Bạn cần nhập giá sản phẩm',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải là số dương',
            'image.required' => 'Bạn cần chọn hình ảnh cho sản phẩm',
            'image.image' => 'Hình ảnh không hợp lệ',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
            'description.required' => 'Bạn cần nhập mô tả sản phẩm',
            'category_id.required' => 'Bạn cần chọn danh mục cho sản phẩm',
        ];
    }
}
