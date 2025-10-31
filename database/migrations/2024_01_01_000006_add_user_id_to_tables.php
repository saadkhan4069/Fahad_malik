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
            $table->foreignId('user_id')->nullable()->after('company_id')->constrained()->onDelete('cascade');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('company_id')->constrained()->onDelete('cascade');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('company_id')->constrained()->onDelete('cascade');
        });

        Schema::table('labels', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('company_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labels', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
