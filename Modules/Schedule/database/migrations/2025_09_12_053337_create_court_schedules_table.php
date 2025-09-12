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

        Schema::create('court_schedules', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('court_id');
//            $table->foreign('court_id')->references('id')->on('courts');
            $table->foreignId('court_id')->constrained('courts')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('time_slot');
            $table->date('date');
            $table->integer('price');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('membership_price');
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->boolean('is_blocked')->default(false);
            $table->unique(['court_id', 'date', 'start_time', 'end_time']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_schedules');
    }
};
