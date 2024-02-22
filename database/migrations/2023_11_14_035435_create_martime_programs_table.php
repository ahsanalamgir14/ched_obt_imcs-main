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
        Schema::create('maritime_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mhei_id')->constrained()->restrictOnDelete();
            $table->string("course");
            $table->string("description")->nullable();
            $table->string("status")->default('OFFERED'); //offered, not offered
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
        Schema::dropIfExists('maritime_programs');
    }
};
