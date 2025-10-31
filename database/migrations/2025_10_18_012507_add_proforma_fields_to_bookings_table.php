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
            // Shipper additional fields
            $table->string('shipper_city')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('shipper_state')->nullable();
            $table->string('shipper_zip')->nullable();
            $table->string('shipper_cnic')->nullable();
            $table->string('shipper_ntn')->nullable();
            
            // Consignee additional fields
            $table->string('consignee_city')->nullable();
            $table->string('consignee_country')->nullable();
            $table->string('consignee_state')->nullable();
            $table->string('consignee_zip')->nullable();
            $table->string('consignee_attention')->nullable();
            
            // Invoice fields
            $table->string('goods_value_currency')->default('USD');
            $table->string('hs_code')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->string('unit')->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->string('dox_type')->default('NON-DOX');
            $table->string('form_e_number')->nullable();
            $table->json('invoice_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'shipper_city',
                'shipper_country',
                'shipper_state',
                'shipper_zip',
                'shipper_cnic',
                'shipper_ntn',
                'consignee_city',
                'consignee_country',
                'consignee_state',
                'consignee_zip',
                'consignee_attention',
                'goods_value_currency',
                'hs_code',
                'quantity',
                'unit',
                'rate',
                'dox_type',
                'form_e_number',
                'invoice_items'
            ]);
        });
    }
};
