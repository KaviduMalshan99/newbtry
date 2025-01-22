<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLubricantOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('lubricant_orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('order_id', 10)->unique(); // Unique order identifier
            $table->unsignedBigInteger('coustomer_id')->nullable(); // Foreign key for customer
            $table->enum('order_type', ['New Order', 'Old Battery', 'Repair'])->default('New Order'); // Order type
            $table->json('items')->nullable(); // JSON for storing multiple items
            $table->string('all_id')->nullable(); // Optional additional ID
            $table->decimal('lubricant_discount', 10, 2)->nullable(); // Discount specific to lubricants
            $table->decimal('subtotal', 10, 2); // Subtotal amount
            $table->decimal('total_price', 10, 2); // Total price
            $table->decimal('paid_amount', 10, 2)->default(0); // Amount paid
            $table->decimal('due_amount', 10, 2)->default(0); // Due amount
            $table->enum('payment_type', ['Cash', 'Card', 'Bank Transfer'])->default('Cash'); // Payment method
            $table->enum('payment_status', ['Not Completed', 'Completed', 'Pending'])->default('Pending'); // Payment status
            $table->string('unit')->nullable(); // Unit of measurement
            $table->string('measurement')->nullable(); // Measurement details
            $table->string('measurement_type')->nullable(); // Type of measurement
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('lubricant_orders');
    }
}
