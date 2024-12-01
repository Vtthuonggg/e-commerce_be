<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Upload hình ảnh.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        // Định nghĩa các quy tắc xác thực
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'folder' => 'nullable|string', // Thư mục lưu trữ tùy chọn
        ]);

        // Kiểm tra xác thực
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $folder = $request->input('folder', 'images'); // Mặc định lưu trong thư mục 'images'
            $path = $request->file('image')->store($folder, 'public');

            // Lấy URL của hình ảnh đã lưu
            $url = asset('storage/' . $path);

            return response()->json([
                'message' => 'Hình ảnh đã được upload thành công.',
                'url' => $url,
                'path' => $path,
            ], 200);
        }

        return response()->json(['error' => 'Không có hình ảnh nào được gửi.'], 400);
    }
}
