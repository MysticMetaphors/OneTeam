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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name', 255);
        $table->string('owner', 255);
        $table->string('image', 255);
        $table->string('description', 255)->nullable();
        $table->enum('status', ['Complete', 'In progress', 'On hold', 'New'])->default('New');
        $table->enum('is_deleted', ['true', 'false'])->default('false');
        $table->dateTime('deadline');
        $table->dateTime('start_date');
        $table->timestamps();
    });

    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('project_id');
        $table->unsignedBigInteger('issued_to');
        $table->string('title', 255);
        $table->string('description', 255);
        $table->string('attachment', 255)->nullable();
        $table->string('type', 255)->nullable();
        $table->enum('priority', ['High', 'Medium', 'Low'])->default('Low');
        $table->enum('status', ['Completed', 'Processing', 'Cancelled', 'Waiting'])->default('Waiting');
        $table->enum('is_repeat', ['true', 'false'])->default('false');
        $table->unsignedBigInteger('repeat_interval')->nullable();
        $table->enum('is_deleted', ['true', 'false'])->default('false');
        $table->dateTime('deadline');
        $table->timestamps();

        $table->foreign('issued_to')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
    });
}

};
