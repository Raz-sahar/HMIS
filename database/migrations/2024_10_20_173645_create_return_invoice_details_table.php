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
        Schema::create('return_invoice_details', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->unsignedBigInteger('return_id');  // Foreign Key to Return Invoice
            $table->unsignedBigInteger('product_id');  // Foreign Key to Product
            $table->string('medicine_name', 255);
            $table->integer('quantity')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->timestamps();  // created_at

            // Foreign Key Constraints
            // $table->foreign('return_id')->references('id')->on('return_invoices')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_invoice_details');
    }
};
