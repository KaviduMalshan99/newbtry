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
        Schema::create('repair_batteries', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('brand_id');
            $table->string('model_number');
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->boolean('isForSelling')->default(0);
            $table->boolean('isActive')->default(1);
            $table->integer('stock_quantity')->nullable();
            $table->date('added_date')->default(now());
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_batteries');
    }
};