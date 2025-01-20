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
        Schema::create('lubricant_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0); // New column
            $table->decimal('due_amount', 10, 2)->default(0);  // New column
            $table->enum('payment_type', ['Cash', 'Card', 'Bank Transfer'])->default('Cash');
            $table->enum('payment_status', ['Not Completed', 'Completed', 'Pending'])->default('Pending'); // New column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricant_purchase');
    }
};