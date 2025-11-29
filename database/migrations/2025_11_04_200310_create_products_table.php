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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dongxe')->constrained('dongxe')->onDelete('cascade');
            $table->varchar('ten_sp');
            $table->text('hinhanh');
            $table->text('chitiet');
            $table->int('hienthi');
            $table->text('thongso');
            $table->timestamps('thoigiantao');
            $table->text('mota');
            $table->varchar('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
