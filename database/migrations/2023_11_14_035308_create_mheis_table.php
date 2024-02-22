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
        Schema::create('mheis', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->unique();
            $table->string('school_type'); //public, private
            $table->string('region');
            $table->string('address');
            $table->string('status')->default('ENABLED'); //enabled, disabled
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
        Schema::dropIfExists('mheis');
    }
};
