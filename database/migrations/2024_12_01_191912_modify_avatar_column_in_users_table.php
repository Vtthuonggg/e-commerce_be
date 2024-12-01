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
        Schema::table('users', function (Blueprint $table) {
            // Thay đổi kiểu dữ liệu hoặc thêm cột nếu chưa có
            $table->string('avatar', 255)->nullable()->change(); // Nếu cột đã tồn tại nhưng sai kiểu
            // Hoặc thêm cột nếu chưa có
            // $table->string('avatar', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Khôi phục lại
            // $table->dropColumn('avatar');
            $table->text('avatar')->nullable()->change(); // Nếu bạn muốn khôi phục kiểu dữ liệu ban đầu
        });
    }
};
