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
        Schema::create('neglect_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_id')->references('id')->on('interview_forms')->onDelete('cascade');
            $table->string('neglect_complaint')->nullable();
            $table->string('neglect_other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neglect_complaints');
    }
};
