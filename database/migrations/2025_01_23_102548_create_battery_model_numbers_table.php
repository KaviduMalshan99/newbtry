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
        Schema::create('battery_model_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battery_id')->constrained('batteries')->onDelete('cascade');
            $table->foreignId('battery_purchase_id')->nullable()->constrained('battery_purchases')->onDelete('cascade');
            $table->string('model_number')->unique(); // Add unique constraint
            $table->boolean('is_active')->default(true);
            $table->foreignId('battery_order_id')->nullable()->constrained('battery_orders')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_model_numbers');
    }
};