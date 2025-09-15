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
        Schema::table('product_types', function (Blueprint $table) {
            // Drop the old unique on slug (adjust name if yours differs)
            try {
                $table->dropUnique('product_types_slug_unique');
            } catch (\Throwable $e) {
                // ignore if it doesn't exist
            }

            // Add composite unique (parent_id, slug)
            $table->unique(['parent_id', 'slug'], 'product_types_parent_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_types', function (Blueprint $table) {
            try {
                $table->dropUnique('product_types_parent_slug_unique');
            } catch (\Throwable $e) {}

            $table->unique('slug', 'product_types_slug_unique');
        });
    }
};
