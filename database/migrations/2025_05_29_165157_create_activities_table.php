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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issued_to');
            $table->string('title', 255);
            $table->string('description', 255);
            $table->dateTime('deadline');
            $table->enum('priority', ['High', 'Mild', 'Low'])->default('Low');
            $table->enum('status', ['Completed', 'Processing', 'Cancelled'])->default('false');
            $table->enum('is_deleted', ['true', 'false'])->default('false');
            $table->timestamps();

            $table->foreign('issued_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
