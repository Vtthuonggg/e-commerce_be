<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email')->get();
        return response()->json($users);
    }


    /**
     * Cập nhật thông tin người dùng hiện tại
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // Lấy người dùng hiện tại
        $user = $request->user();

        // Định nghĩa các quy tắc xác thực
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'store_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'avatar' => 'nullable|string|max:255',
        ]);

        // Kiểm tra xác thực
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'store_name' => $request->store_name,
            'notes' => $request->notes,
            'avatar' => $request->avatar,
        ]);

        return response()->json([
            'message' => 'Thông tin người dùng đã được cập nhật thành công.',
            'user' => $user->only(['id', 'name', 'email', 'phone_number', 'store_name', 'notes', 'avatar']),
        ]);
    }
}
