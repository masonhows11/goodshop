<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title_english')->unique();
            $table->string('title_persian')->unique();
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('seo_desc')->nullable();
            $table->boolean('status')->default(0);
            $table->string('sku')->nullable();
            $table->decimal('weight',10,2)->nullable();
            $table->decimal('length',10,1)->comment('cm unit')->nullable();

            $table->decimal('width',10,1)->nullable();
            $table->decimal('height',10,1)->nullable();

            $table->string('origin_price')->nullable();
            $table->tinyInteger('marketable')->default(1);

            $table->string('tags')->nullable();
            $table->bigInteger('views')->nullable();
            $table->double('available_in_stock')->default(0);
            $table->integer('number_sold')->default(0);
            $table->integer('frozen_number')->default(0);
            $table->integer('salable_quantity')->default(0);

            $table->timestamp('published_at')->nullable();

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');


            $table->softDeletes();
            $table->timestamps();
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
}
