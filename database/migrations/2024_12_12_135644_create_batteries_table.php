<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('batteries', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('model_name');
            $table->unsignedBigInteger('brand_id');
            $table->integer('capacity'); // e.g., in Ah
            $table->string('voltage', 10); // e.g., "12V"
            $table->string('type'); // Battery Type (e.g., Lead-Acid, Lithium-ion)
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->integer('warranty_period'); // Warranty period in months
            $table->date('manufacturing_date');
            $table->date('expiry_date')->nullable(); // Nullable for batteries without an expiry date
            $table->integer('stock_quantity');
            $table->date('added_date')->default(now()); // Automatically set to current date
            $table->string('image')->nullable(); // Nullable for optional images
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('batteries');
    }
};