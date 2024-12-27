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
        Schema::create('other_incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_id')->references('id')->on('interview_forms')->onDelete('cascade');
            $table->json('other_incident')->nullable();
            $table->json('duration_abuse')->nullable();
            $table->string('witnessed')->nullable();
            $table->json('site_abuse')->nullable();
            $table->string('witness')->nullable();
            $table->string('relation_child')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_incidents');
    }
};
