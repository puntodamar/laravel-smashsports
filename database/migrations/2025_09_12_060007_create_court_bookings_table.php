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
        Schema::create('court_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('court_schedule_id')->constrained('court_schedules')->cascadeOnDelete();
            $table->string('reference_number')->nullable();
            $table->enum('status', ['pending','paid','cancelled'])->default('pending');
            $table->enum('membership_type', ['membership', 'incidental']);
            $table->foreignId('rescheduled_from_booking_id')->nullable()->constrained('court_bookings')->nullOnDelete();

            $table->timestamps();
            $table->unique('court_schedule_id');
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_bookings');
    }
};
