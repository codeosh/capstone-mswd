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
        Schema::create('deferring_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_id')->references('id')->on('interview_forms')->onDelete('cascade');
            $table->string('deferring_interview')->nullable();
            $table->string('deferring_other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deferring_interviews');
    }
};
