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
        Schema::create('price_rules', function (Blueprint $t) {
            $t->id();
            // global or per court
            $t->foreignId('court_id')->nullable()->constrained('courts')->cascadeOnDelete();
            $t->enum('applies_to', ['incidental','membership','both'])->default('both');
            $t->enum('weekday', ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);
            $t->time('start_time');
            $t->time('end_time');
            $t->unsignedInteger('price');
            $t->smallInteger('priority')->default(0);
            $t->date('valid_from')->nullable();
            $t->date('valid_to')->nullable();
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->index(['court_id','weekday','start_time','end_time','applies_to','active']);
        });

        Schema::table('court_bookings', function (Blueprint $t) {
            $t->unsignedInteger('charged_price')->after('status'); // immutable snapshot
        });

        Schema::table('court_schedules', function (Blueprint $t) {
            $t->unsignedInteger('cached_price')->nullable()->after('price');
            $t->unsignedInteger('cached_membership_price')->nullable()->after('membership_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_rules');
    }
};
