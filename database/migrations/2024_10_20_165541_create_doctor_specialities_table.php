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
        Schema::create('doctor_specialities', function (Blueprint $table) {  // Primary Key (id column)
            $table->unsignedBigInteger('employee_id');  // Foreign Key to Employee Table
            $table->string('specialty_name', 255);  
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->unsignedBigInteger('created_by');  
            $table->unsignedBigInteger('updated_by')->nullable();  
            $table->unsignedBigInteger('deleted_by')->nullable();  
            $table->timestamps();  
            $table->softDeletes();  

            // Foreign Keys
            // $table->foreign('employee_id')->references('id')->on('employees');
            // $table->foreign('created_by')->references('id')->on('users');  
            // $table->foreign('updated_by')->references('id')->on('users');
            // $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_specialities');
    }
};
