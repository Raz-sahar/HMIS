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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->unsignedBigInteger('patient_id');  // Foreign Key to Patient
            $table->unsignedBigInteger('doctor_id');  // Foreign Key to Doctor
            $table->string('invoice_no', 50)->unique();  
            $table->date('invoice_date');  
            $table->unsignedBigInteger('created_by');  // Foreign Key to User
            $table->timestamps();  // created_at
            $table->dateTime('print_date')->nullable();  
            $table->integer('total_quantity')->nullable();  
            $table->decimal('total_amount', 10, 2)->nullable();  
            $table->unsignedBigInteger('discount_id')->nullable();  // Foreign Key to Discount
            $table->string('discount_reason')->nullable();  
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');  
            $table->enum('payment_method', ['cash', 'card', 'insurance'])->nullable();  
        
            // Foreign Key Constraints
            // $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            // $table->foreign('doctor_id')->references('id')->on('employees')->onDelete('cascade');
            // $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
