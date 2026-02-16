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
        Schema::create('compression_reports', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('original_format', 10);
            $table->string('output_format', 10);
            $table->unsignedBigInteger('original_size');
            $table->unsignedBigInteger('compressed_size');
            $table->decimal('reduction_percent', 5, 1);
            $table->unsignedInteger('quality');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->index('created_at');
            $table->index('original_format');
            $table->index('output_format');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compression_reports');
    }
};
