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
        Schema::create('listens', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file');
            $table->text('transcript')->nullable();
            $table->timestamps();
        });

        Schema::create('sounds', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('img')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sounds');
        Schema::dropIfExists('listens');
    }
};
