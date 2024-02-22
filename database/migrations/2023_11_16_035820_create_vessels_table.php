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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_company_id')->constrained()->restrictOnDelete();
            $table->string('imo_number')->unique();
            $table->string('registry_number')->unique()->nullable();
            $table->string('vessel_name')->unique();
            $table->string('vessel_type');
            $table->double('grt');
            $table->double('kw');
            $table->string('flag');
            $table->string('route');
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
        Schema::dropIfExists('vessels');
    }
};
