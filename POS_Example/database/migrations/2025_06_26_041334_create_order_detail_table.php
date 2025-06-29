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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id'); // FK to order.id
            $table->unsignedBigInteger('menu_id');  // FK to menus.id

            $table->decimal('price', 8, 2);
            $table->decimal('amount', 8, 2);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
