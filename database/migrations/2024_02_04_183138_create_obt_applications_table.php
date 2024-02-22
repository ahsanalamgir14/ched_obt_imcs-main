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
        Schema::create('obt_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('applicable_id');
            $table->string('applicable_type');
            $table->string('status')->default('PENDING');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('obt_applications');
    }
};
