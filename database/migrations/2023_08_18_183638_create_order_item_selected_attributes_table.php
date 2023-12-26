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
        Schema::create('order_item_selected_attributes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');

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
        Schema::dropIfExists('order_item_selected_attributes');
    }
};
