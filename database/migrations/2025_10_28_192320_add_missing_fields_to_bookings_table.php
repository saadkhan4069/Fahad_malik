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
            $table->decimal('shipment_charges', 10, 2)->nullable()->after('inco_terms');
            $table->date('estimated_date')->nullable()->after('shipment_charges');
            $table->string('shipment_reference')->nullable()->after('estimated_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['shipment_charges', 'estimated_date', 'shipment_reference']);
        });
    }
};
