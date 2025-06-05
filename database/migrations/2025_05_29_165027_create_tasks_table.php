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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issued_to');
            $table->string('title', 255);
            $table->string('description', 255);
            $table->enum('priority', ['High', 'Mild', 'Low'])->default('Low');
            $table->enum('status', ['Completed', 'Processing', 'Cancelled'])->default('false');
            $table->enum('is_deleted', ['true', 'false'])->default('false');
            $table->dateTime('deadline');
            $table->timestamps();

            $table->foreign('issued_to')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('name', 255);
            $table->string('owner', 255);
            $table->string('image', 255);
            $table->string('description', 255)->nullable();
            $table->enum('status', ['Complete', 'In progress'. 'On hold'])->default('On hold');
            $table->enum('is_deleted', ['true', 'false'])->default('false');
            $table->dateTime('deadline');
            $table->dateTime('start_date');
            $table->timestamps();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
