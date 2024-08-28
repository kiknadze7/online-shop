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
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
            $table->foreignId('cart_id')->constrained();
            $table->string('contact_number');
            $table->string('address');
            $table->unsignedInteger('total_product');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('product_quantity');
            $table->enum('status', ['new', 'active', 'finished', 'rejected', 'stale'])->default('new');
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
