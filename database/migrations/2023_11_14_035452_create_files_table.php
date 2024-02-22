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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_number')->unique();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('file_type'); //css, journal
            $table->foreignId('uploader')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('recepient')->references('id')->on('users')->restrictOnDelete();
            $table->string('link');
            $table->foreignId('created_by')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('updated_by')->references('id')->on('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
