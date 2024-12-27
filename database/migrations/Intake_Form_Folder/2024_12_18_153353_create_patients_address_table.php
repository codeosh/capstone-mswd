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
        Schema::create('patients_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intake_id')->references('id')->on('intake_forms')->onDelete('cascade');
            $table->string('mother_address')->nullable();
            $table->string('mother_direction')->nullable();
            $table->string('present_direction')->nullable();
            $table->string('mother_telephone')->nullable();
            $table->string('present_telephone')->nullable();
            $table->string('present_caretaker')->nullable();
            $table->string('legal_status')->nullable();
            $table->string('relation_child')->nullable();
            $table->string('enrolled_school')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('family_contact')->nullable();
            $table->string('family_address')->nullable();
            $table->string('contact_relationchild')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_address');
    }
};
