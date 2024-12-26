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
        Schema::create('battery_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battery_purchase_id')->constrained('battery_purchases')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('battery_id')->nullable()->constrained('batteries')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('purchase_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_purchase_items');
    }
};
