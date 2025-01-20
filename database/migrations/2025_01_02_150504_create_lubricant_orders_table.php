<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLubricantOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('lubricant_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('c_phone_number');
            $table->enum('order_type', ['New Order', 'Old Battery', 'Repair'])->default('New Order');
            $table->date('order_date');
            $table->json('items'); // lubricant_id, quantity, price
            $table->decimal('battery_discount', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0); // New column
            $table->decimal('due_amount', 10, 2)->default(0);  // New column
            $table->enum('payment_type', ['Cash', 'Card', 'Bank Transfer'])->default('Cash');
            $table->enum('payment_status', ['Not Completed', 'Completed', 'Pending'])->default('Pending'); // New column
            $table->string('unit');
            $table->string('mesurement');
            $table->string('mesurement_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lubricant_orders');
    }
}
