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
        Schema::create('identity_verification_freelancers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('freelancer_id')->constrained('freelancers')->onDelete('cascade');
            $table->string('id_card_number');
            $table->string('front_image');
            $table->string('selfie_image');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignUlid('reviewed_by')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_verification_freelancers');
    }
};
