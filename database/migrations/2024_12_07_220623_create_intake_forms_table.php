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
        Schema::create('intake_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('cascade');
            $table->date('intake_date');
            $table->integer('case_num')->nullable();
            $table->string('relation_child')->nullable();
            $table->string('social_worker')->nullable();
            $table->longText('other_information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intake_form');
    }
};
