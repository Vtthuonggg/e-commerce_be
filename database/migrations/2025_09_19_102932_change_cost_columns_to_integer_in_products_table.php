<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
 * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) { // Sửa từ 'integer_in_products' thành 'products'
            $table->bigInteger('retail_cost')->unsigned()->default(0)->change();
            $table->bigInteger('base_cost')->unsigned()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) { // Sửa từ 'integer_in_products' thành 'products'
            $table->decimal('retail_cost', 10, 2)->default(0)->change();
            $table->decimal('base_cost', 10, 2)->default(0)->change();
        });
    }
};