<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // We use after('email') to place it logically in the table structure
            // constrained() automatically links it to the 'id' on the 'roles' table
            $table->foreignId('role_id')
                  ->nullable() 
                  ->after('email') 
                  ->constrained()
                  ->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};