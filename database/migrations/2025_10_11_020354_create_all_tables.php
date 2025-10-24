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
            $table->integer('order')->default(0);
            $table->timestamps();
        });
        // --- 2. Units ---
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // --- 3. Lessons ---
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // --- 4. Words ---
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('source')->unique();
            $table->string('ipa')->nullable();
            $table->json('mean')->nullable();
            $table->timestamps();
        });

        // --- 5. Pivot Lesson_Word ---
        Schema::create('lesson_word', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->foreignId('word_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // --- 6. Pages ---
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('lesson_word');
        Schema::dropIfExists('words');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('units');
        Schema::dropIfExists('courses');
    }
};
