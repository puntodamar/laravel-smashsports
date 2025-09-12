<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_blackouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('court_id')->constrained('courts')->cascadeOnDelete();

            // Per-schedule window (e.g., 2025-09-12 08:00 → 10:00)
            $table->timestampTz('start_at');
            $table->timestampTz('end_at');

            // Scope: 'membership_only' means incidental bookings are still allowed
            $table->enum('scope', ['all', 'membership_only'])->default('membership_only');

            $table->boolean('reschedule_membership_next_week')->default(true);

            $table->string('reason')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['court_id', 'start_at', 'end_at', 'scope']);
        });

        DB::statement("
                ALTER TABLE schedule_blackouts
                ADD CONSTRAINT schedule_blackouts_chk CHECK (end_at > start_at)
            ");

        //prevent overlapping blackouts on the same court
        DB::statement('CREATE EXTENSION IF NOT EXISTS btree_gist;');
        DB::statement("
                ALTER TABLE schedule_blackouts
                ADD CONSTRAINT schedule_blackouts_no_overlap
                EXCLUDE USING gist (
                    court_id WITH =,
                    tstzrange(start_at, end_at) WITH &&
                )
            ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        DB::statement('ALTER TABLE schedule_blackouts DROP CONSTRAINT IF EXISTS schedule_blackouts_no_overlap;');
        DB::statement('ALTER TABLE schedule_blackouts DROP CONSTRAINT IF EXISTS schedule_blackouts_chk;');
        Schema::dropIfExists('schedule_blackouts');
    }
};
