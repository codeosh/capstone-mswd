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
        Schema::create('physical_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_id')->references('id')->on('interview_forms')->onDelete('cascade');
            $table->string('physical_complaint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_complaints');
    }
};
