<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->id();
            $table->string('boat_dept_id')->unique(); // Unique Department ID (e.g., BT-101)
            $table->string('boat_image')->nullable();
            $table->integer('capacity'); // Max people allowed
            $table->string('owner_name');
            $table->string('owner_mobile', 15);
            
            // Status: Active (Allowed to raft) or Inactive (Maintenance/Suspended)
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            // Link to the Uploader
            $table->foreignId('uploader_id')->constrained('users');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boats');
    }
};