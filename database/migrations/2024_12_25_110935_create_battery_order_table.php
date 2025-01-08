<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatteryOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // In create_battery_orders_table.php (Migration)
    public function up()
    {
        Schema::create('battery_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->enum('order_type', ['New Order', 'Old Battery', 'Repair'])->default('New Order');
            $table->date('order_date');
            $table->json('items'); // battery_id, quantity, price
            $table->decimal('battery_discount', 10, 2)->nullable();
            $table->decimal('old_battery_discount_value', 10, 2)->nullable;
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0); // New column
            $table->decimal('due_amount', 10, 2)->default(0);  // New column
            $table->enum('payment_type', ['Cash', 'Card', 'Bank Transfer'])->default('Cash');
            $table->enum('payment_status', ['Not Completed', 'Completed', 'Pending'])->default('Pending'); // New column
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('battery_order');
    }
}