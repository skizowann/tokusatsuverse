<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('series_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['watching', 'completed', 'plan_to_watch'])->default('plan_to_watch');
            $table->timestamps();

            $table->unique(['user_id', 'series_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};