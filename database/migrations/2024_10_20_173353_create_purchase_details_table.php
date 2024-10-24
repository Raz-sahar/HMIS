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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->unsignedBigInteger('purchase_id');  // Foreign Key to Purchase Main
            $table->unsignedBigInteger('product_id');  // Foreign Key to Product
            $table->string('batch_no')->nullable();
            $table->date('mgf_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('bonus_quantity')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->timestamps();  // created_at

            // Foreign Key Constraints
            // $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
