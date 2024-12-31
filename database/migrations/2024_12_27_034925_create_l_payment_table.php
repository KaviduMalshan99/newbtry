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
        Schema::create('l_payment', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique();
            $table->enum('product_type', ['batteries', 'lubricant', 'both']);
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('status');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('purchase_id')->nullable(); // Add purchase_id
            $table->timestamps();
    
            $table->foreign('purchase_id')->references('id')->on('lubricant_purchases')->onDelete('set null'); // Foreign key to lubricant_purchases
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_payment');
    }
};
