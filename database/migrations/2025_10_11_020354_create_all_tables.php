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
        // --- 1. Courses ---
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
        // --- 2. Units ---
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->integer('unit_number')->unsigned();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // --- 3. Lessons ---
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->integer('lesson_number')->unsigned();
            $table->text('vocabulary')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        // --- Words ---
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word')->unique();
            $table->string('ipa')->nullable();
            $table->string('vn')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('units');
        Schema::dropIfExists('courses');
    }
};
