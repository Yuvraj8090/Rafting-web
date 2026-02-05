<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raft_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('dept_id')->unique(); // Unique Department ID
            $table->string('name');
            $table->string('aadhaar', 12)->unique();
            $table->string('mobile', 15);
            $table->string('profile_image')->nullable();
            $table->string('company_name')->nullable(); // For Phase 2
            
            // Status Management
            $table->enum('status', ['pending', 'approved', 'suspended'])->default('pending');
            
            // Foreign Key to Users (Who uploaded this driver)
            $table->foreignId('uploader_id')->constrained('users');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raft_drivers');
    }
};