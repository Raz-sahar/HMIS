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
        Schema::create('service_receipts', function (Blueprint $table) {
            $table->id();  // Primary Key (receipt_id)
            $table->unsignedBigInteger('patient_id');  
            $table->unsignedBigInteger('service_type_id');  
            $table->unsignedBigInteger('service_id');  
            $table->unsignedBigInteger('referred_doctor_id')->nullable();  
            $table->unsignedBigInteger('discount_id')->nullable();  
            $table->text('discount_reason')->nullable();  
            $table->decimal('total_amount', 10, 2);  
            $table->enum('payment_status', ['pending', 'paid']);  
            $table->string('payment_method')->nullable();  
            $table->date('receipt_date');  
            $table->unsignedBigInteger('created_by');  
            $table->unsignedBigInteger('updated_by')->nullable();  
            $table->unsignedBigInteger('deleted_by')->nullable();  
            $table->boolean('is_active')->default(true);  
            $table->boolean('is_delete')->default(false);  
            $table->timestamps();  // created_at, updated_at
            $table->softDeletes();  // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_receipts');
    }
};
