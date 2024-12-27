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
        Schema::create('primary_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intake_id')->references('id')->on('intake_forms')->onDelete('cascade');
            $table->string('primary_complaint');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_complaints');
    }
};
