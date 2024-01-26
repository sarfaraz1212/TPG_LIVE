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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default("C");
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fee'); 
            $table->date('startdate');
            $table->date('enddate');
            $table->string('gender');
            $table->string('goals');
            $table->string('package');
            $table->string('bodyweight');
            $table->string('height');
            $table->string('medical_condition')->nullable();
            $table->string('contact');
            $table->string('address');
            $table->string('profile');
            $table->integer('assigned_trainer');
            $table->timestamps();
            $table->integer('status')->default(1); 
            $table->boolean('verified')->default(0); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
