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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('country');
            $table->text('bio')->nullable();
            $table->float('rating')->default(0);
            $table->unsignedInteger('completed_projects')->default(0);
            $table->date('registration_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token', 64)->nullable();
            $table->timestamp('verification_token_sent_at')->nullable();
            $table->boolean('is_verified_id_card')->default(false);
            $table->integer('points_balance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelacers');
    }
};
