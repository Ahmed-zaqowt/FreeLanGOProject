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
        Schema::table('users', function (Blueprint $table) {
             $table->string('verification_token', 64)->nullable();
            $table->timestamp('verification_token_sent_at')->nullable();
            $table->boolean('is_verified_id_card')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('verification_token');
            $table->dropColumn('verification_token_sent_at');
            $table->dropColumn('is_verified_id_card');
        });
    }
};
