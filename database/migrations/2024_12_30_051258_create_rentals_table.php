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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Foreign Key to Customers
            $table->foreignId('old_battery_id')->constrained('old_batteries')->onDelete('cascade'); // Foreign Key to Old Batteries
            $table->date('rental_start_date');
            $table->date('rental_end_date')->nullable(); // Planned End Date
            $table->date('actual_return_date')->nullable(); // Actual Return Date
            $table->decimal('rental_cost', 10, 2);
            $table->decimal('late_return_fee', 10, 2)->nullable();
            $table->decimal('damage_fee', 10, 2)->nullable();

            $table->decimal('advance_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->enum('payment_type', ['Cash', 'Card', 'Bank Transfer'])->default('Cash');
            $table->enum('payment_status', ['Not Completed', 'Completed', 'Pending'])->default('Pending');

            $table->decimal('total_cost', 10, 2)->nullable();
            $table->text('notes')->nullable(); // Optional Notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
