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
        Schema::create('cart_item_selected_attributes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cart_item_id')->nullable();
            $table->foreign('cart_item_id')->references('id')->on('cart_items')->onDelete('cascade');

            $table->unsignedBigInteger('category_attribute_id')->nullable();
            $table->foreign('category_attribute_id')->references('id')->on('category_attributes')->onDelete('cascade');

            $table->unsignedBigInteger('category_value_id')->nullable();
            $table->foreign('category_value_id')->references('id')->on('category_values')->onDelete('cascade');

            $table->string('value')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item_selected_attributes');
    }
};
