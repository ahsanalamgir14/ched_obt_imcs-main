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
        Schema::create('pcg_staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('rank');
            $table->string('unit_assigned');
            $table->string('unit_address');
            $table->date('birthdate');
            $table->string('contact_number')->unique();
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
        Schema::dropIfExists('pcg_staffs');
    }
};
