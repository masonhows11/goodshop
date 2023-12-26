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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number',64)->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->longText('addresses_object')->nullable();

            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->longText('payment_object')->nullable();

            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->foreign('delivery_id')->references('id')->on('delivery')->onDelete('cascade');
            $table->longText('delivery_object')->nullable();

            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->longText('coupon_object')->nullable();

            $table->decimal('order_coupon_discount_amount',20,3)->nullable();

            $table->unsignedBigInteger('common_discount_id')->nullable();
            $table->foreign('common_discount_id')->references('id')->on('common_discount')->onDelete('cascade');

            $table->longText('common_discount_object')->nullable();

            $table->decimal('order_common_discount_amount',20,3)->nullable();

            $table->decimal('delivery_amount',20,3)->nullable();

            $table->tinyInteger('delivery_status')->default(0);

            $table->timestamp('delivery_date')->nullable();

            $table->tinyInteger('payment_type')->default(0);

            $table->tinyInteger('payment_status')->default(0);

            $table->decimal('order_final_amount',20,3)->nullable();

            $table->decimal('order_discount_amount',20,3)->nullable();

            $table->decimal('order_total_products_discount_amount',20,3)->nullable();

            $table->tinyInteger('order_status')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
