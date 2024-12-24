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
        Schema::create('study_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade'); // FK to users
            $table->enum('degree_level', ['bachelor', 'master', 'doctorate']);
            $table->year('year');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK to users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_plans');
    }
};
