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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject',128)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('seen')->default(0)->comment('0 => unseen , 1 => seen');

            $table->foreignId('reference_id')->nullable();
            $table->foreign('reference_id')->references('id')
                ->on('ticket_admins')->onUpdate('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')
                ->on('ticket_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('priority_id')->nullable();
            $table->foreign('priority_id')->references('id')
                ->on('ticket_priorities')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->foreign('ticket_id')->references('id')
                ->on('tickets')->onDelete('cascade')->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
