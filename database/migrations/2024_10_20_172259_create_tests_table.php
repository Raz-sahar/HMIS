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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->string('name');  
            $table->text('result')->nullable();  
            $table->string('unit')->nullable();  
            $table->string('normal_range')->nullable();  
            $table->text('description')->nullable();  
            $table->decimal('amount', 10, 2);  
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
        Schema::dropIfExists('tests');
    }
};
