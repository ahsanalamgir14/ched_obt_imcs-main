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
        Schema::create('mhei_staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('mhei_id')->constrained()->restrictOnDelete();
            $table->date('birthdate')->nullable();
            $table->string('gender');
            $table->string('contact_number')->unique()->nullable();
            $table->string('position')->nullable(); //dean, supervisor
            $table->string('educational_background')->nullable();
            $table->boolean('top_level_access')->default(false);
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
        Schema::dropIfExists('mhei_staffs');
    }
};