<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Company;

class BookingTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        
        if (!$company) {
            $this->command->error('No company found. Please create a company first.');
            return;
        }

        $this->command->info('Creating 1000 test bookings...');

        for ($i = 1; $i <= 1000; $i++) {
            Booking::create([
                'company_id' => $company->id,
                'booking_number' => 'BK' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'cn_number' => 'CN' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'shipper_name' => 'Shipper ' . $i,
                'consignee_name' => 'Consignee ' . $i,
                'service_type' => ['express', 'standard', 'economy'][rand(0, 2)],
                'status' => ['pending', 'confirmed', 'cancelled'][rand(0, 2)],
                'total_cost' => rand(1000, 50000),
                'booking_date' => now()->subDays(rand(0, 365)),
                'shipper_city' => 'City ' . $i,
                'shipper_country' => 'Pakistan',
                'consignee_city' => 'City ' . $i,
                'consignee_country' => 'Pakistan',
                'shipper_cnic' => '12345' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'shipper_phone' => '0300' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'consignee_phone' => '0301' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'shipper_address' => 'Address ' . $i,
                'consignee_address' => 'Address ' . $i,
                'shipper_state' => 'State ' . $i,
                'consignee_state' => 'State ' . $i,
                'shipper_zip' => '12345',
                'consignee_zip' => '54321',
                'shipper_email' => 'shipper' . $i . '@example.com',
                'consignee_email' => 'consignee' . $i . '@example.com',
                'pickup_date' => now()->addDays(rand(1, 30)),
                'delivery_date' => now()->addDays(rand(30, 60)),
                'financial_instrument' => 'Y',
                'package_description' => 'Package ' . $i,
                'package_value' => rand(1000, 50000),
                'weight' => rand(1, 100),
                'dimensions' => '10x10x10',
                'special_instructions' => 'Instructions ' . $i,
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now()->subDays(rand(0, 365))
            ]);

            if ($i % 100 == 0) {
                $this->command->info("Created {$i} bookings...");
            }
        }

        $this->command->info('Successfully created 1000 test bookings!');
    }
}