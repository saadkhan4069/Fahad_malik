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
        Schema::table('labels', function (Blueprint $table) {
            $table->string('individual_tracking_number')->nullable()->after('tracking_code');
            $table->string('individual_status')->default('pending')->after('individual_tracking_number');
            $table->text('individual_tracking_notes')->nullable()->after('individual_status');
            $table->timestamp('individual_estimated_delivery')->nullable()->after('individual_tracking_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labels', function (Blueprint $table) {
            $table->dropColumn([
                'individual_tracking_number',
                'individual_status',
                'individual_tracking_notes',
                'individual_estimated_delivery'
            ]);
        });
    }
};
