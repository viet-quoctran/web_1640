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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->dateTime('commentDate');
            $table->unsignedBigInteger('contribution_id');
            $table->unsignedBigInteger('coordinator_id');
            $table->foreign('contribution_id')->references('id')->on('contributions')->onDelete('cascade');
            $table->foreign('coordinator_id')->references('id')->on('coordinators')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
