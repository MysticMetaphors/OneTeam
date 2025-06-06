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
    // Create `projects` table first
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name', 255);
        $table->string('owner', 255);
        $table->string('image', 255);
        $table->string('description', 255)->nullable();
        $table->enum('status', ['Complete', 'In progress', 'On hold'])->default('On hold'); // Also fix the typo here: comma instead of period
        $table->enum('is_deleted', ['true', 'false'])->default('false');
        $table->dateTime('deadline');
        $table->dateTime('start_date');
        $table->timestamps();
    });

    // Then create `tasks` table
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('project_id');
        $table->unsignedBigInteger('issued_to');
        $table->string('title', 255);
        $table->string('description', 255);
        $table->enum('priority', ['High', 'Mild', 'Low'])->default('Low');
        $table->enum('status', ['Completed', 'Processing', 'Cancelled', 'Waiting'])->default('Waiting');
        $table->enum('is_deleted', ['true', 'false'])->default('false');
        $table->dateTime('deadline');
        $table->timestamps();

        $table->foreign('issued_to')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
    });
}

};
