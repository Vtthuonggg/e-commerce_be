<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $type = $request->query('type', 1);
        $size = (int) $request->query('size', 20); // size mặc định là 20
        $page = (int) $request->query('page', 1);
        $products = Product::where('type', $type)
            ->paginate($size, ['*'], 'page', $page);
        return response()->json($products);
    }
    // Lấy tất cả nguyên liệu
    public function getIngredients()
    {
        $ingredients = Product::where('type', 2)->get();
        return response()->json($ingredients);
    }

    // Lấy tất cả sản phẩm bán
    public function getSellableProducts()
    {
        $products = Product::where('type', 1)->with('requiredIngredients')->get();
        return response()->json($products);
    }

    // Tạo sản phẩm mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'retail_cost' => 'required|numeric|min:0',
            'base_cost' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|integer|in:1,2',
            'unit' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create(array_merge(
            $request->validated(),
            ['user_id' => $request->user()->id]
        ));

        return response()->json([
            'message' => 'Sản phẩm đã được tạo thành công.',
            'product' => $product
        ], 201);
    }

    // Thêm công thức cho sản phẩm bán
    public function addRecipe(Request $request, $productId)
    {
        $product = Product::where('type', 1)->findOrFail($productId); // 1 là sellable

        $validator = Validator::make($request->all(), [
            'ingredients' => 'required|array',
            'ingredients.*.ingredient_id' => 'required|exists:products,id',
            'ingredients.*.quantity_needed' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        foreach ($request->ingredients as $ingredient) {
            $product->requiredIngredients()->syncWithoutDetaching([
                $ingredient['ingredient_id'] => ['quantity_needed' => $ingredient['quantity_needed']]
            ]);
        }

        return response()->json([
            'message' => 'Công thức đã được cập nhật.',
            'product' => $product->load('requiredIngredients')
        ]);
    }
}
