<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Company;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        
        if (!$company) {
            echo "No company found. Please run CompanySeeder first.\n";
            return;
        }

        // Create sample bookings with complete data
        $bookings = [
            [
                'company_id' => $company->id,
                'booking_number' => 'BK' . strtoupper(uniqid()),
                'cn_number' => '7610007585',
                'status' => 'confirmed',
                'shipper_name' => 'MUHAMMAD SHOAIB ISMAIL',
                'shipper_email' => 'shipper@example.com',
                'shipper_phone' => '3100034399',
                'shipper_address' => 'H NO L-582 SEC 5, A-4 AREA NORTH KARACHI',
                'shipper_city' => 'KARACHI',
                'shipper_country' => 'PAKISTAN',
                'shipper_state' => 'SINDH',
                'shipper_zip' => '75800',
                'shipper_cnic' => '42101-0417726-5',
                'shipper_ntn' => 'B066709-1',
                'consignee_name' => 'MR ZULFI',
                'consignee_email' => 'consignee@example.com',
                'consignee_phone' => '1559419961',
                'consignee_address' => 'C18, NAJMAT MARAFID TOWER, FLAT NO 703, 7TH FLOOR.. REEM ISLAND, ABU DHABI, UAE',
                'consignee_city' => 'ABU DHABI',
                'consignee_country' => 'UNITED ARAB EMIRATES',
                'consignee_state' => 'ABU DHABI',
                'consignee_zip' => '00000',
                'consignee_attention' => 'ATTENTION REQUIRED',
                'package_description' => '5 MEN SUITS',
                'package_value' => 25.00,
                'weight' => 7.60,
                'dimensions' => [
                    'length' => 50,
                    'width' => 30,
                    'height' => 20,
                ],
                'service_type' => 'LAST MILE UAE DELIVERY',
                'pickup_date' => Carbon::now()->addDays(1),
                'delivery_date' => Carbon::now()->addDays(5),
                'special_instructions' => 'Handle with care',
                'total_cost' => 25.00, // 5.0 * 5.00
                'booking_date' => Carbon::now(),
                'goods_value_currency' => 'USD',
                'hs_code' => '6203',
                'quantity' => 5.0,
                'unit' => 'PCS',
                'rate' => 5.00,
                'dox_type' => 'NON-DOX',
                'form_e_number' => 'FE123456',
                'invoice_items' => [
                    [
                        'description' => '5 MEN SUITS',
                        'made_of' => 'Cotton',
                        'weight' => 7.60,
                        'hs_code' => '6203',
                        'quantity' => 5.0,
                        'unit' => 'PCS',
                        'rate' => 5.00,
                    ]
                ],
            ],
            [
                'company_id' => $company->id,
                'booking_number' => 'BK' . strtoupper(uniqid()),
                'cn_number' => '153448',
                'status' => 'pending',
                'shipper_name' => 'Mercedes William',
                'shipper_email' => 'mercedes@example.com',
                'shipper_phone' => '+1 (974) 819-6794',
                'shipper_address' => 'Do temporibus sit co',
                'shipper_city' => 'KARACHI',
                'shipper_country' => 'PAKISTAN',
                'shipper_state' => 'SINDH',
                'shipper_zip' => '75800',
                'shipper_cnic' => '42101-0417726-5',
                'shipper_ntn' => '',
                'consignee_name' => 'Yoshio Forbes',
                'consignee_email' => 'yoshio@example.com',
                'consignee_phone' => '+1 (121) 753-1861',
                'consignee_address' => 'Temporibus cillum do',
                'consignee_city' => 'ABU DHABI',
                'consignee_country' => 'UNITED ARAB EMIRATES',
                'consignee_state' => 'ABU DHABI',
                'consignee_zip' => '00000',
                'consignee_attention' => '',
                'package_description' => 'Electronics',
                'package_value' => 100.00,
                'weight' => 2.5,
                'dimensions' => [
                    'length' => 30,
                    'width' => 20,
                    'height' => 15,
                ],
                'service_type' => 'overnight',
                'pickup_date' => Carbon::now()->addDays(1),
                'delivery_date' => Carbon::now()->addDays(2),
                'special_instructions' => 'Fragile items',
                'total_cost' => 50.00, // 1.0 * 50.00
                'booking_date' => Carbon::now(),
                'goods_value_currency' => 'USD',
                'hs_code' => '8517',
                'quantity' => 1.0,
                'unit' => 'PCS',
                'rate' => 50.00,
                'dox_type' => 'NON-DOX',
                'form_e_number' => '',
                'invoice_items' => [
                    [
                        'description' => 'Electronics',
                        'made_of' => 'Plastic',
                        'weight' => 2.5,
                        'hs_code' => '8517',
                        'quantity' => 1.0,
                        'unit' => 'PCS',
                        'rate' => 50.00,
                    ]
                ],
            ]
        ];

        foreach ($bookings as $bookingData) {
            Booking::updateOrCreate(
                ['cn_number' => $bookingData['cn_number']],
                $bookingData
            );
        }

        echo "Sample bookings created successfully!\n";
    }
}
