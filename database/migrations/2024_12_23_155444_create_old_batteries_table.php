<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('old_batteries', function (Blueprint $table) {
            $table->bigIncrements('old_battery_id'); // Set the correct column name as primary key
            $table->foreignId('order_id')->constrained('orders');
            $table->string('old_battery_type');
            $table->string('old_battery_condition');
            $table->decimal('old_battery_value', 8, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_batteries');
    }
};
