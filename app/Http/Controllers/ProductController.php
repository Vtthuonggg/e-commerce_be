<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Lấy tất cả nguyên liệu
    public function getIngredients()
    {
        $ingredients = Product::ingredients()->get();
        return response()->json($ingredients);
    }

    // Lấy tất cả sản phẩm bán
    public function getSellableProducts()
    {
        $products = Product::sellable()->with('requiredIngredients')->get();
        return response()->json($products);
    }

    // Tạo sản phẩm mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:ingredient,sellable',
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
        $product = Product::sellable()->findOrFail($productId);

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
