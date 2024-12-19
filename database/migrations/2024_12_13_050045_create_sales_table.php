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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->json('battery_ids')->nullable(); // JSON field to store multiple battery IDs
            $table->json('lubricant_ids')->nullable(); // JSON field to store multiple lubricant IDs
            $table->integer('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
