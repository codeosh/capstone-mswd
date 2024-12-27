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
        Schema::create('families_composition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intake_id')->references('id')->on('intake_forms')->onDelete('cascade');
            $table->string('composition_relation')->nullable();
            $table->string('composition_name')->nullable();
            $table->string('composition_live')->nullable();
            $table->string('composition_agegender')->nullable();
            $table->string('composition_civilstatus')->nullable();
            $table->string('composition_employed')->nullable();
            $table->string('composition_occupation')->nullable();
            $table->string('composition_education')->nullable();
            $table->string('composition_income')->nullable();
            $table->string('composition_school')->nullable();
            $table->string('composition_contact')->nullable();
            $table->string('socio_economic')->nullable();
            $table->string('children_num')->nullable();
            $table->string('family_members')->nullable();
            $table->string('family_household')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families_composition');
    }
};
