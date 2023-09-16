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
        Schema::create('diets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('trainer_id');
            $table->string('meals')->nullable();
            $table->string('protein')->nullable();
            $table->string('carbs')->nullable();
            $table->string('fats')->nullable();
            $table->string('calories')->nullable();
            $table->string('total_calories')->nullable();
            $table->string('total_protein')->nullable();
            $table->string('total_carbs')->nullable();
            $table->string('total_fats')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diets');
    }
};
