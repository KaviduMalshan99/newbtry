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
       
        Schema::create('lubricant_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lubricant_order_id');
            $table->unsignedBigInteger('lubricant_id');
            $table->timestamps();
        
            // Foreign key relationships
            $table->foreign('lubricant_order_id')->references('id')->on('lubricant_orders')->onDelete('cascade');
            $table->foreign('lubricant_id')->references('id')->on('lubricants')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricant_order_items');
    }
};
