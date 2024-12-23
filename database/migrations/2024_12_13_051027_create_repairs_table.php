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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id(); // Repair ID
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete(); // Foreign Key to Customers
            $table->foreignId('repair_battery_id')->constrained('repair_batteries')->cascadeOnDelete(); // Foreign Key to Repair Batteries
            $table->date('repair_order_start_date');
            $table->date('repair_order_end_date')->nullable();
            $table->text('diagnostic_report')->nullable();
            $table->json('items_used')->nullable();
            $table->decimal('repair_cost', 10, 2)->nullable();
            $table->decimal('labor_charges', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->enum('repair_status', ['In Progress', 'Completed'])->default('In Progress');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
