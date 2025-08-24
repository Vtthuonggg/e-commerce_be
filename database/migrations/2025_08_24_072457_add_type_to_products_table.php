<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('type')->default('sellable')->after('stock'); // 'ingredient' hoặc 'sellable'
            $table->string('unit')->nullable()->after('type'); // Đơn vị tính (kg, lít, cái...)
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['type', 'unit']);
        });
    }
};
