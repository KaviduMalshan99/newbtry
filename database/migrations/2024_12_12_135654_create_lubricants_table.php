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
        Schema::create('lubricants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand_id');
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('unit')->nullable();
            $table->string('volume', 50)->nullable();
            $table->string('total_count', 50)->nullable();
            $table->string('image')->nullable(); // New image column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('lubricants');
    }
};
