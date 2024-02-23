<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('path');
            $table->string('fileable_type', 160);
            $table->unsignedBigInteger('fileable_id');
            $table->string('type')->comment('file_type renamed');

            //Adjusted fields
            $table->string('file_number')->unique();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->foreignId('uploader')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('recepient')->references('id')->on('users')->restrictOnDelete();
            $table->string('link');
            $table->foreignId('created_by')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('updated_by')->references('id')->on('users')->restrictOnDelete();

            $table->timestamps();

            $table->index(['fileable_type', 'fileable_id'], 'fileable_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
