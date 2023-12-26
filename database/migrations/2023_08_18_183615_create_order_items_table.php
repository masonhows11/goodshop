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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->longText('product_object')->nullable();

            $table->unsignedBigInteger('amazing_sale_id')->nullable();
            $table->foreign('amazing_sale_id')->references('id')->on('amazing_sales')->onDelete('cascade');
            $table->longText('amazing_sale_object')->nullable();

            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');

            $table->unsignedBigInteger('guarantee_id')->nullable();
            $table->foreign('guarantee_id')->references('id')->on('guarantees')->onDelete('cascade');

            $table->integer('number')->default(1);
            $table->decimal('amazing_sale_discount_amount',20,3)->nullable();

            // price per each product
            $table->decimal('final_product_price',20,3)->nullable();
            // price for total of each product
            $table->decimal('final_total_price',20,3)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
