<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'retail_cost', 'base_cost', 'stock', 'category_id', 'type', 'user_id'];
    protected $casts = [
        'retail_cost' => 'integer',
        'base_cost' => 'integer',
        'stock' => 'float',
        'type' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'integer',
    ];
    // Constants cho type
    const TYPE_SELLABLE = 1; // Sản phẩm bán
    const TYPE_INGREDIENT = 2; // Nguyên liệu

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope để lọc nguyên liệu
    public function scopeIngredients($query)
    {
        return $query->where('type', self::TYPE_INGREDIENT);
    }

    // Scope để lọc sản phẩm bán
    public function scopeSellable($query)
    {
        return $query->where('type', self::TYPE_SELLABLE);
    }

    // Quan hệ với nguyên liệu cần dùng (nếu là sản phẩm bán)
    public function requiredIngredients()
    {
        return $this->belongsToMany(Product::class, 'product_recipes', 'product_id', 'ingredient_id')
            ->withPivot('quantity_needed')
            ->where('products.type', self::TYPE_INGREDIENT);
    }

    // Quan hệ với sản phẩm sử dụng (nếu là nguyên liệu)
    public function usedInProducts()
    {
        return $this->belongsToMany(Product::class, 'product_recipes', 'ingredient_id', 'product_id')
            ->withPivot('quantity_needed')
            ->where('products.type', self::TYPE_SELLABLE);
    }
}
