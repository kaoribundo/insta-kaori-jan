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
        Schema::create('follows', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('follower');
            $table->unsignedBigInteger('following');
            // $table->timestamps();

            $table->foreign('follower')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('following')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};