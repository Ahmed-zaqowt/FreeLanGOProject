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
        Schema::create('freelancer_skills', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('freelancer_id')->constrained('freelancers')->onDelete('cascade');
            $table->foreignUlid('skill_id')->constrained('skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_skills');
    }
};
