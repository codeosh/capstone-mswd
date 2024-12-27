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
        Schema::create('arrangement_time_abuse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intake_id')->references('id')->on('intake_forms')->onDelete('cascade');
            $table->string('living_arrangement')->nullable();
            $table->string('ngo_shelter')->nullable();
            $table->string('govt_agency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrangement_time_abuse');
    }
};
