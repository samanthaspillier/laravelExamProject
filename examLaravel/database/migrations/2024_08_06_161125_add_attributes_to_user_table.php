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

        Schema::table('users', function (Blueprint $table) {
        
            //Add birthday column
            if (!Schema::hasColumn('users', 'birthday')) {
            $table->date('birthday')->nullable();
            }
            // Add avatar column
            if (!Schema::hasColumn('users', 'avatar')) {
            $table->string('avatar')->nullable(); // Avatar is stored as a file path
            }
            // Add bio column
            if (!Schema::hasColumn('users', 'bio')) {
            $table->text('bio')->nullable();
            }
            // Add role column
            if (!Schema::hasColumn('users', 'is_admin')) {
            $table->boolean('is_admin')->default(false);
            }


        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['birthday', 'username', 'bio', 'is_admin']);
        });
    }
};
