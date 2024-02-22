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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('maritime_program_id')->constrained()->restrictOnDelete();
            $table->foreignId('file_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('student_number')->unique();
            $table->string('sirb_number')->unique()->nullable(); //optional
            $table->string('sid_number')->unique()->nullable(); //optional
            $table->string('gender'); //Male, Female
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('religion')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('contact_number')->unique()->nullable();
            $table->foreignId('resume_id')->nullable()->references('id')->on('users')->restrictOnDelete();
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
        Schema::dropIfExists('students');
    }
};
