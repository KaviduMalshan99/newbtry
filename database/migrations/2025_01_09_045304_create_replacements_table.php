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
        Schema::create('replacements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign Key: Order ID
            $table->unsignedBigInteger('old_battery_id')->nullable(); // Foreign Key: Old Battery ID
            $table->string('replacement_reason'); // Reason for Replacement
            $table->date('replacement_date'); // Date of Replacement
            $table->decimal('old_battery_price', 10, 2)->nullable(); // Price of Old Battery
            $table->unsignedBigInteger('new_battery_id'); // Foreign Key: New Battery ID
            $table->decimal('new_battery_price', 10, 2); // Price of New Battery
            $table->decimal('price_adjustment', 10, 2); // Difference in Prices
            $table->enum('refund_payment_status', ['Not Processed', 'Completed'])->default('Not Processed'); // Refund/Payment Status
            $table->text('notes')->nullable(); // Optional Notes

            // Foreign Key Constraints
            $table->foreign('order_id')->references('id')->on('battery_orders')->onDelete('cascade');
            $table->foreign('old_battery_id')->references('id')->on('old_batteries')->onDelete('set null');
            $table->foreign('new_battery_id')->references('id')->on('batteries')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replacements');
    }
};