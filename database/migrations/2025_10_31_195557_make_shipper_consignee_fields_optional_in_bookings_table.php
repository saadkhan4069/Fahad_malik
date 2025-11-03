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
            $table->string('shipper_email')->nullable()->change();
            $table->string('shipper_phone')->nullable()->change();
            $table->text('shipper_address')->nullable()->change();
            $table->string('consignee_email')->nullable()->change();
            $table->string('consignee_phone')->nullable()->change();
            $table->text('consignee_address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('shipper_email')->nullable(false)->change();
            $table->string('shipper_phone')->nullable(false)->change();
            $table->text('shipper_address')->nullable(false)->change();
            $table->string('consignee_email')->nullable(false)->change();
            $table->string('consignee_phone')->nullable(false)->change();
            $table->text('consignee_address')->nullable(false)->change();
        });
    }
};
