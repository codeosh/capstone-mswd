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
        Schema::create('childcases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('cascade');
            $table->string('pantawid_beneficiary')->nullable();
            $table->string('offense_committed')->nullable();
            $table->string('status')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childcases');
    }
};
