<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');      // ID sản phẩm bán
            $table->unsignedBigInteger('ingredient_id');   // ID nguyên liệu
            $table->decimal('quantity_needed', 8, 2);      // Số lượng nguyên liệu cần
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('products')->onDelete('cascade');

            $table->unique(['product_id', 'ingredient_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_recipes');
    }
};
