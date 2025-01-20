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
        Schema::create('lubricant_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_id')->unique(); // Add purchase_id
            $table->unsignedBigInteger('lubricant_id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('purchase_date');
            $table->integer('quantity_purchased');
            $table->string('unit_type');
            $table->decimal('total_cost', 10, 2);
            $table->string('payment_status');
            $table->string('status');
            $table->timestamps();

            $table->foreign('lubricant_id')->references('id')->on('lubricants')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricant_purchases');
    }
};
