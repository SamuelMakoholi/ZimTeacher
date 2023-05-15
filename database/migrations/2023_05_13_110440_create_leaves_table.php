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
        Schema::disableForeignKeyConstraints();

        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('start_date', 50);
            $table->string('end_date', 50);
            $table->string('leave_type', 200);
            $table->string('reason_for_leave', 200);
            $table->string('status', 50);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
