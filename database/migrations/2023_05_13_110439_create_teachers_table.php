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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            // $table->string('full_name', 400);
            // $table->string('email', 100);
            $table->string('gender', 20);
            $table->string('phone', 400);
            $table->string('id_no', 100);
            $table->string('dob', 30);
            $table->string('grade_level', 200);
            $table->string('district', 100);
            $table->string('province', 100);
            $table->string('class_course', 255);
            $table->string('qualification', 400);
            $table->string('school', 150);
            // $table->string('password', 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
