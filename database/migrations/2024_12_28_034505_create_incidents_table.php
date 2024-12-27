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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_id')->references('id')->on('interview_forms')->onDelete('cascade');
            $table->string('info_from')->nullable();
            $table->date('date_recent_incident')->nullable();
            $table->time('time_recent_incident')->nullable();
            $table->string('other_recent_clues')->nullable();
            $table->date('date_first_abuse')->nullable();
            $table->time('time_first_abuse')->nullable();
            $table->string('other_first_abuse')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
