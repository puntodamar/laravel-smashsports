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
        Schema::create('price_overrides', function (Blueprint $t) {
            $t->id();
            $t->foreignId('court_id')->nullable()->constrained('courts')->cascadeOnDelete();
            $t->enum('applies_to', ['incidental','membership','both'])->default('both');
            $t->date('date');
            $t->time('start_time');
            $t->time('end_time');
            $t->unsignedInteger('price');
            $t->string('reason')->nullable();
            $t->timestamps();
            $t->unique(['court_id','applies_to','date','start_time','end_time']);
            $t->index(['date','court_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_overrides');
    }
};
