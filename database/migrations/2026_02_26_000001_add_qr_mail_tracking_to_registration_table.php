<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->timestamp('qr_mail_queued_at')->nullable()->after('qr_code_value');
            $table->timestamp('qr_mail_sent_at')->nullable()->after('qr_mail_queued_at');
        });
    }

    public function down(): void
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->dropColumn(['qr_mail_queued_at', 'qr_mail_sent_at']);
        });
    }
};
