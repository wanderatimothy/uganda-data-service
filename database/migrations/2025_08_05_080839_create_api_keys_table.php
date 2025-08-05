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
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('api_keys_public_key');
            $table->longText('api_keys_private_key');
            $table->timestamp('api_keys_expiry');
            $table->string('api_keys_app_name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.u
     */
    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
};
