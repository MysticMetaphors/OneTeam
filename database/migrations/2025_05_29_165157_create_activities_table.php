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
            $table->unsignedBigInteger('made_by');
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('action', 255);
            $table->enum('type', ['Project', 'Task'])->default('Task');
            $table->enum('is_deleted', ['true', 'false'])->default('false');
            $table->timestamps();

            $table->foreign('made_by')->references('id')->on('users')->onDelete('cascade');
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
