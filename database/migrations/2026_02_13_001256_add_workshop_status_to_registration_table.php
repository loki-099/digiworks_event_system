<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration', function (Blueprint $table) {
            // Adding the missing column with a default value
            $table->string('workshop_status')->default('registered')->after('workshop_id');
        });
    }

    public function down(): void
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->dropColumn('workshop_status');
        });
    }
};
