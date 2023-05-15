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

        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('current_place', 400);
            $table->string('from_school', 200);
            $table->string('to_school', 200);
            $table->string('reason_for_transfer', 400);
            $table->string('date_of_transfer', 400);
            $table->string('status', 20);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
