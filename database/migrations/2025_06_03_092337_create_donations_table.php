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
        Schema::create('donations', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('amount')->nullable();
            $table->enum('category', ['money', 'food', 'clothes']);
            $table->date('date');
            $table->timestamp('prefered_time');
            $table->string('location');
            $table->string('phone');
            $table->enum('status', ['pending', 'assigned', 'collected'])->default('pending');
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade')->nullable();
            $table->foreignId('volunteer_id')->constrained('volunteers')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
