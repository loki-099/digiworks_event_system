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
        // Create Pitching table
        Schema::create('pitching', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registration')->cascadeOnDelete();
            $table->string('group_name');
            $table->string('organization');
            $table->string('team_members');
            $table->timestamps();
        });

        // Update Registration table
        Schema::table('registration', function (Blueprint $table) {
            $table->string('is_pitching')->nullable()->after('is_going');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration', function(Blueprint $table) {
            $table->dropColumn('is_pitching');
        });

        Schema::dropIfExists('pitching');
    }
};
