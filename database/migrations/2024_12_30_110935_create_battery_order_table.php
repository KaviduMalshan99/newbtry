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
        $table->string('payment_method');
        $table->text('items'); // Store items as JSON or serialize them
        $table->decimal('subtotal', 10, 2);
        $table->decimal('total', 10, 2);
        $table->timestamps();
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
