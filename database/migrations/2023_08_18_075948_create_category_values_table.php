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
        Schema::create('category_values', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('category_attribute_id')->nullable();
            $table->foreign('category_attribute_id')->references('id')->on('category_attributes')->onDelete('cascade');

            $table->string('value');
            $table->decimal('price_increase',10,2)->default(0);
            $table->tinyInteger('type')->default('0')->comment('value type is 0 => simple, 1 => multi values select by customers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_values');
    }
};
