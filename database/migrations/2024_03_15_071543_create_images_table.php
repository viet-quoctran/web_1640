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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger('user_id'); // Thêm cột user_id
            $table->unsignedBigInteger('contribution_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Thiết lập khóa ngoại cho user_id
            $table->foreign('contribution_id')->references('id')->on('contributions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
