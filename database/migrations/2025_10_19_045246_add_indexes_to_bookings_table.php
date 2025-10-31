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
        Schema::table('bookings', function (Blueprint $table) {
            // Add indexes for better performance on large datasets
            $table->index('company_id');
            $table->index('status');
            $table->index('service_type');
            $table->index('booking_date');
            $table->index('created_at');
            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'created_at']);
            $table->index(['shipper_name', 'company_id']);
            $table->index(['consignee_name', 'company_id']);
            $table->index(['booking_number', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['company_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['service_type']);
            $table->dropIndex(['booking_date']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['company_id', 'status']);
            $table->dropIndex(['company_id', 'created_at']);
            $table->dropIndex(['shipper_name', 'company_id']);
            $table->dropIndex(['consignee_name', 'company_id']);
            $table->dropIndex(['booking_number', 'company_id']);
        });
    }
};