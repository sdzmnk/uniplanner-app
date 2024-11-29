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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('study_plans')->onDelete('cascade'); // FK to study_plans
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK to users
            $table->string('action'); // Дія (create, update, delete)
            $table->timestamps();
        });
    }

    /**
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
