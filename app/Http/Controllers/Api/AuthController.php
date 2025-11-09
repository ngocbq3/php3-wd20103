<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // Đăng ký
    public function register(Request $request)
    {
        // ✅ VALIDATE dữ liệu
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // password_confirmation required
        ]);
        //Thông báo lỗi khi nhập sai dữ liệu
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // ✅ TẠO người dùng
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ✅ TẠO token
        $token = $user->createToken('auth_token')->plainTextToken;

        // ✅ TRẢ VỀ
        return response()->json([
            'message' => 'Đăng ký thành công',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Đăng nhập
    public function login(Request $request)
    {
        // ✅ VALIDATE
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        //nếu có lỗi validate thì gửi thông báo lỗi
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // ✅ TÌM người dùng
        $user = User::where('email', $request->email)->first();

        // ✅ KIỂM TRA password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email hoặc mật khẩu không đúng'], 401);
        }

        // ✅ TẠO token
        $token = $user->createToken('auth_token')->plainTextToken;
        //Thông báo đăng nhập thành công
        return response()->json([
            'message' => 'Đăng nhập thành công',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        // ✅ XÓA token hiện tại
        $request->user()->currentAccessToken()->delete();
        // Thông báo đăng xuất thành công
        return response()->json(['message' => 'Đăng xuất thành công']);
    }
}
