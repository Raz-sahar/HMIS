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
        Schema::create('test_referrals', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->unsignedBigInteger('service_id');  // Foreign Key from Service
            $table->unsignedBigInteger('patient_id');  // Foreign Key from Patient Registration
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
        Schema::dropIfExists('test_referrals');
    }
};
