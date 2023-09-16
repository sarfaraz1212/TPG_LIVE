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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('T');
            $table->string('trainer_number');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('contact');
            $table->string('address');
            $table->string('body_weight');
            $table->string('height');
            $table->enum('gender', ['M', 'F', 'O']);
            $table->string('picture'); 
            $table->string('certifications'); 
            $table->string('documents');
            $table->date('start_date');
            $table->string('dob');
            $table->string('salary'); 
            $table->string('medical_condition')->nullable(); 
            $table->string('programs'); 
            $table->string('skills'); 
            $table->string('mode'); 
            $table->enum('verified', [0, 1])->default(0);
            $table->string('deleted_at')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
