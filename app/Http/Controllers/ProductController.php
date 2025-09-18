<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Lấy danh sách products
    public function index(Request $request)
    {
        $type = $request->query('type', 1);
        $size = (int) $request->query('size', 20);
        $page = (int) $request->query('page', 1);
        
        $query = Product::where('type', $type)
            ->where('user_id', auth()->id())
            ->with(['category']);
        
        $total = $query->count();
        $products = $query->paginate($size, ['*'], 'page', $page);
        
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Thao tác thành công!',
            'data' => $products->items(),
            'meta' => [
                'total' => $total,
                'size' => $size,
                'current_page' => $page,
                'last_page' => $products->lastPage()
            ]
        ]);
    }

    // Tạo product mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'retail_cost' => 'required|int|min:0',
            'base_cost' => 'required|int|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|integer|in:1,2',
            'unit' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Dữ liệu không hợp lệ!',
                'data' => $validator->errors()
            ], 422);
        }

        $product = Product::create(array_merge(
            $request->all(),
            ['user_id' => auth()->id()]
        ));

        return response()->json([
            'success' => true,
            'status' => 201,
            'message' => 'Sản phẩm đã được tạo thành công!',
            'data' => $product->load('category')
        ], 201);
    }

    // Lấy chi tiết product
    public function show($id)
    {
        $product = Product::where('user_id', auth()->id())
            ->with(['category', 'requiredIngredients'])
            ->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Không tìm thấy sản phẩm!',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Thao tác thành công!',
            'data' => $product
        ]);
    }

    // Cập nhật product
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', auth()->id())->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Không tìm thấy sản phẩm!',
                'data' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'retail_cost' => 'sometimes|required|integer|min:0',
            'base_cost' => 'sometimes|required|integer|min:0',
            'stock' => 'sometimes|required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'sometimes|required|integer|in:1,2',
            'unit' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Dữ liệu không hợp lệ!',
                'data' => $validator->errors()
            ], 422);
        }

        $product->update($request->all());

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Sản phẩm đã được cập nhật thành công!',
            'data' => $product->load('category')
        ]);
    }

    // Xóa product
    public function destroy($id)
    {
        $product = Product::where('user_id', auth()->id())->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Không tìm thấy sản phẩm!',
                'data' => null
            ], 404);
        }

        // Xóa các quan hệ recipes trước
        $product->requiredIngredients()->detach();
        $product->usedInProducts()->detach();
        
        // Xóa product
        $product->delete();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Sản phẩm đã được xóa thành công!',
            'data' => null
        ]);
    }

    // Lấy tất cả nguyên liệu
    public function getIngredients()
    {
        $ingredients = Product::where('type', 2)
            ->where('user_id', auth()->id())
            ->with('category')
            ->get();
            
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Thao tác thành công!',
            'data' => $ingredients,
            'meta' => [
                'total' => $ingredients->count(),
                'size' => $ingredients->count()
            ]
        ]);
    }

    // Lấy tất cả sản phẩm bán
    public function getSellableProducts()
    {
        $products = Product::where('type', 1)
            ->where('user_id', auth()->id())
            ->with(['category', 'requiredIngredients'])
            ->get();
            
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Thao tác thành công!',
            'data' => $products,
            'meta' => [
                'total' => $products->count(),
                'size' => $products->count()
            ]
        ]);
    }

    // Thêm công thức cho sản phẩm bán
    public function addRecipe(Request $request, $productId)
    {
        $product = Product::where('type', 1)
            ->where('user_id', auth()->id())
            ->find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'status' => 404,
                'message' => 'Không tìm thấy sản phẩm!',
                'data' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'ingredients' => 'required|array',
            'ingredients.*.ingredient_id' => 'required|exists:products,id',
            'ingredients.*.quantity_needed' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Dữ liệu không hợp lệ!',
                'data' => $validator->errors()
            ], 422);
        }

        // Xóa recipes cũ và thêm mới
        $product->requiredIngredients()->detach();
        
        foreach ($request->ingredients as $ingredient) {
            $product->requiredIngredients()->attach($ingredient['ingredient_id'], [
                'quantity_needed' => $ingredient['quantity_needed']
            ]);
        }

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Công thức đã được cập nhật thành công!',
            'data' => $product->load('requiredIngredients')
        ]);
    }
}