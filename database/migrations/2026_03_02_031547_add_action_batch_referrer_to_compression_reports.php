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
        Schema::table('compression_reports', function (Blueprint $table) {
            $table->string('action', 20)->default('compress')->after('user_agent');
            $table->string('batch_id', 36)->nullable()->after('action')->index();
            $table->string('referrer', 500)->nullable()->after('batch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compression_reports', function (Blueprint $table) {
            $table->dropColumn(['action', 'batch_id', 'referrer']);
        });
    }
};
