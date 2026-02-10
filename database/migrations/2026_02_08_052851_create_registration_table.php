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
Schema::create('registration', function (Blueprint $table) {
    $table->id();

    $table->foreignId('attendee_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->foreignId('event_id')
        ->constrained('event')
        ->cascadeOnDelete();

    
    $table->unsignedBigInteger('workshop_id')->nullable();

    $table->foreign('workshop_id')
        ->references('id')
        ->on('workshop')
        ->nullOnDelete();

    $table->string('qr_code_value')->unique()->nullable();
    $table->string('status')->default('registered');
    $table->timestamp('registered_date');
    $table->timestamp('updated_at');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
