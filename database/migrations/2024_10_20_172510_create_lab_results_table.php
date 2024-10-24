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
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->unsignedBigInteger('patient_id');  // Foreign Key from Patient Registration
            $table->unsignedBigInteger('test_id');  // Foreign Key from Test
            $table->unsignedBigInteger('referred_doctor_id');  // Foreign Key from Doctor Registration
            $table->date('reporting_date')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();  
            $table->boolean('is_active')->default(true);  
            $table->boolean('is_delete')->default(false);  
            $table->timestamps();  // created_at, updated_at
            $table->softDeletes();  // deleted_at
            $table->text('result_value')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};
