<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product_title');
            $table->string('product_price');
            $table->longText('description');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('sub_cat_id');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('category');
            $table->foreign('sub_cat_id')->references('id')->on('sub_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
