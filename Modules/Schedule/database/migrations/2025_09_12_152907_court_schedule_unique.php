<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('court_schedules', function (Blueprint $table) {
            // unique key to match ON CONFLICT (court_id, date, "time")
            $table->unique(['court_id', 'date', 'time_slot'], 'court_schedules_court_date_time_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('court_schedules', function (Blueprint $table) {
            $table->dropUnique('court_schedules_court_date_time_unique');
        });
    }
};
