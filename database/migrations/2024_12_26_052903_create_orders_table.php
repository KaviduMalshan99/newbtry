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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('battery_id');
            $table->enum('order_type', ['New Order', 'Old Battery', 'Repair']);
            $table->date('order_date');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->decimal('old_battery_discount', 10, 2)->nullable();
            $table->enum('payment_status', ['Paid', 'Unpaid']);
            $table->enum('order_status', ['Completed', 'Pending']);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('battery_id')->references('id')->on('batteries')->onDelete('cascade');
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