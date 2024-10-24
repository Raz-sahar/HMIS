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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->unsignedBigInteger('product_id');  // Foreign Key from Product
            $table->string('batch_no')->nullable();
            $table->integer('quantity_in_stock');
            $table->integer('minimum_required_quantity')->nullable();  // new
            $table->integer('reorder_level')->nullable();  // new
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->timestamps();  // created_at, updated_at
            $table->softDeletes();  // deleted_at

            // Foreign Key Constraint
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
