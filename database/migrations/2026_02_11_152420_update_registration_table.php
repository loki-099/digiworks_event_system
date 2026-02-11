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
        //
        Schema::table('registration', function (Blueprint $table) {
            $table->boolean('is_going')->default(true)->after('workshop_id'); // Going for the main event, change to 'is_going' later
            $table->string('workshop_status')->default('registered')->after('status'); // Status for the workshop, can be 'registered', 'attended', 'not_attended'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
