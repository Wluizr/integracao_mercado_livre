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
        Schema::create('mercado_livre_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->string('token_type');
            $table->string('scope');
            $table->string('expires_in');
            $table->string('refresh_token');
            $table->string('user_id');
            $table->boolean('is_valid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mercado_livre_tokens');
    }
};
