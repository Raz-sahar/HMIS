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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();// Primary Key (id column)
            $table->string('name', 100);  // Department Name
            $table->string('code', 10)->unique();  // Department Code
            $table->unsignedBigInteger('department_head');  // Foreign Key to Employee Table
            $table->string('location', 255);
            $table->string('phone_number', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->unsignedBigInteger('created_by');  
            $table->unsignedBigInteger('updated_by')->nullable();  
            $table->unsignedBigInteger('deleted_by')->nullable();  
            $table->timestamps();  
            $table->softDeletes();  

            // Foreign Keys
            // $table->foreign('department_head')->references('id')->on('employees');
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
        Schema::dropIfExists('departments');
    }
};
