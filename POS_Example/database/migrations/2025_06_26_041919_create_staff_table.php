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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string( 'firstName');
            $table->string( 'lastName');
            $table->string( 'nickname');
            $table->string('phoneNubmer')->unique();
            $table->date( 'birthDay');
            $table->enum('role', ['customer', 'staff'])->default('customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
