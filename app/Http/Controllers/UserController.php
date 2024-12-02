<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        if ($request->filled('avatar') && $request->avatar !== $user->avatar) {

            // Giả sử avatar là URL, cần chuyển đổi thành đường dẫn tương đối
            $currentAvatarPath = $this->extractPathFromUrl($user->avatar);
            if ($currentAvatarPath && Storage::disk('public')->exists($currentAvatarPath)) {
                if (Storage::disk('public')->delete($currentAvatarPath)) {
                    // Avatar cũ đã được xóa thành công.
                } else {
                    // Đã xảy ra lỗi khi xóa avatar cũ.
                }
            }
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

    /**
     * Hàm trích xuất đường dẫn tương đối từ URL avatar.
     *
     * @param string $url
     * @return string|null
     */
    private function extractPathFromUrl($url)
    {
        if (!$url) {
            return null;
        }

        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '';

        $storagePrefix = '/storage/';
        if (strpos($path, $storagePrefix) === 0) {
            $relativePath = substr($path, strlen($storagePrefix));
            return $relativePath;
        }

        return null;
    }
}
