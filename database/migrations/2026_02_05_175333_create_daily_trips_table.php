<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_trips', function (Blueprint $table) {
            $table->id();
            
            // The Driver
            $table->foreignId('raft_driver_id')->constrained('raft_drivers')->onDelete('cascade');
            
            // The Boat
            $table->foreignId('boat_id')->constrained('boats')->onDelete('cascade');
            
            // The Verifier (User who scanned the QR)
            $table->foreignId('verifier_id')->constrained('users');
            
            // Trip Metadata
            $table->date('trip_date'); // To easily filter counts per day
            $table->timestamp('verified_at'); // Precise time of entry
            
            // Optional: Store location if you have multiple entry points
            $table->string('entry_point')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_trips');
    }
};