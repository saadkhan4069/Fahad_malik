<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Services
        $services = [
            ['name' => 'Direct UAE Express', 'code' => 'direct_uae_express', 'description' => 'Direct UAE Express service'],
            ['name' => 'Direct UAE Economy', 'code' => 'direct_uae_economy', 'description' => 'Direct UAE Economy service'],
            ['name' => 'Direct UAE DDP', 'code' => 'direct_uae_ddp', 'description' => 'Direct UAE DDP service'],
            ['name' => 'Direct UK Express', 'code' => 'direct_uk_express', 'description' => 'Direct UK Express service'],
            ['name' => 'Direct UK Economy', 'code' => 'direct_uk_economy', 'description' => 'Direct UK Economy service'],
            ['name' => 'Direct Saudi Arabia DDP', 'code' => 'direct_saudi_ddp', 'description' => 'Direct Saudi Arabia DDP service'],
            ['name' => 'Import UAE DDP', 'code' => 'import_uae_ddp', 'description' => 'Import UAE DDP service'],
            ['name' => 'International Import', 'code' => 'international_import', 'description' => 'International Import service'],
            ['name' => 'Via Dubai UPS Economy', 'code' => 'via_dubai_ups_economy', 'description' => 'Via Dubai UPS Economy service'],
            ['name' => 'Via Dubai UPS Express', 'code' => 'via_dubai_ups_express', 'description' => 'Via Dubai UPS Express service'],
            ['name' => 'Via Dubai Aramex', 'code' => 'via_dubai_aramex', 'description' => 'Via Dubai Aramex service'],
            ['name' => 'Via Dubai FedEx', 'code' => 'via_dubai_fedex', 'description' => 'Via Dubai FedEx service'],
            ['name' => 'Via Dubai DHL', 'code' => 'via_dubai_dhl', 'description' => 'Via Dubai DHL service'],
            ['name' => 'Direct Dubai', 'code' => 'direct_dubai', 'description' => 'Direct Dubai service'],
        ];

        // Countries - Comprehensive International List
        $countries = [
            // Major Countries
            ['name' => 'Pakistan', 'code' => 'PK', 'currency' => 'PKR'],
            ['name' => 'United States', 'code' => 'US', 'currency' => 'USD'],
            ['name' => 'United Kingdom', 'code' => 'GB', 'currency' => 'GBP'],
            ['name' => 'Canada', 'code' => 'CA', 'currency' => 'CAD'],
            ['name' => 'Australia', 'code' => 'AU', 'currency' => 'AUD'],
            ['name' => 'Germany', 'code' => 'DE', 'currency' => 'EUR'],
            ['name' => 'France', 'code' => 'FR', 'currency' => 'EUR'],
            ['name' => 'China', 'code' => 'CN', 'currency' => 'CNY'],
            ['name' => 'Japan', 'code' => 'JP', 'currency' => 'JPY'],
            ['name' => 'India', 'code' => 'IN', 'currency' => 'INR'],
            
            // Middle East & Gulf
            ['name' => 'United Arab Emirates', 'code' => 'AE', 'currency' => 'AED'],
            ['name' => 'Saudi Arabia', 'code' => 'SA', 'currency' => 'SAR'],
            ['name' => 'Qatar', 'code' => 'QA', 'currency' => 'QAR'],
            ['name' => 'Kuwait', 'code' => 'KW', 'currency' => 'KWD'],
            ['name' => 'Bahrain', 'code' => 'BH', 'currency' => 'BHD'],
            ['name' => 'Oman', 'code' => 'OM', 'currency' => 'OMR'],
            ['name' => 'Jordan', 'code' => 'JO', 'currency' => 'JOD'],
            ['name' => 'Lebanon', 'code' => 'LB', 'currency' => 'LBP'],
            ['name' => 'Turkey', 'code' => 'TR', 'currency' => 'TRY'],
            ['name' => 'Iran', 'code' => 'IR', 'currency' => 'IRR'],
            ['name' => 'Iraq', 'code' => 'IQ', 'currency' => 'IQD'],
            ['name' => 'Israel', 'code' => 'IL', 'currency' => 'ILS'],
            ['name' => 'Egypt', 'code' => 'EG', 'currency' => 'EGP'],
            
            // Europe
            ['name' => 'Italy', 'code' => 'IT', 'currency' => 'EUR'],
            ['name' => 'Spain', 'code' => 'ES', 'currency' => 'EUR'],
            ['name' => 'Netherlands', 'code' => 'NL', 'currency' => 'EUR'],
            ['name' => 'Belgium', 'code' => 'BE', 'currency' => 'EUR'],
            ['name' => 'Switzerland', 'code' => 'CH', 'currency' => 'CHF'],
            ['name' => 'Austria', 'code' => 'AT', 'currency' => 'EUR'],
            ['name' => 'Sweden', 'code' => 'SE', 'currency' => 'SEK'],
            ['name' => 'Norway', 'code' => 'NO', 'currency' => 'NOK'],
            ['name' => 'Denmark', 'code' => 'DK', 'currency' => 'DKK'],
            ['name' => 'Finland', 'code' => 'FI', 'currency' => 'EUR'],
            ['name' => 'Poland', 'code' => 'PL', 'currency' => 'PLN'],
            ['name' => 'Czech Republic', 'code' => 'CZ', 'currency' => 'CZK'],
            ['name' => 'Hungary', 'code' => 'HU', 'currency' => 'HUF'],
            ['name' => 'Romania', 'code' => 'RO', 'currency' => 'RON'],
            ['name' => 'Bulgaria', 'code' => 'BG', 'currency' => 'BGN'],
            ['name' => 'Croatia', 'code' => 'HR', 'currency' => 'HRK'],
            ['name' => 'Slovenia', 'code' => 'SI', 'currency' => 'EUR'],
            ['name' => 'Slovakia', 'code' => 'SK', 'currency' => 'EUR'],
            ['name' => 'Lithuania', 'code' => 'LT', 'currency' => 'EUR'],
            ['name' => 'Latvia', 'code' => 'LV', 'currency' => 'EUR'],
            ['name' => 'Estonia', 'code' => 'EE', 'currency' => 'EUR'],
            ['name' => 'Ireland', 'code' => 'IE', 'currency' => 'EUR'],
            ['name' => 'Portugal', 'code' => 'PT', 'currency' => 'EUR'],
            ['name' => 'Greece', 'code' => 'GR', 'currency' => 'EUR'],
            ['name' => 'Cyprus', 'code' => 'CY', 'currency' => 'EUR'],
            ['name' => 'Malta', 'code' => 'MT', 'currency' => 'EUR'],
            ['name' => 'Luxembourg', 'code' => 'LU', 'currency' => 'EUR'],
            
            // Asia Pacific
            ['name' => 'South Korea', 'code' => 'KR', 'currency' => 'KRW'],
            ['name' => 'Singapore', 'code' => 'SG', 'currency' => 'SGD'],
            ['name' => 'Malaysia', 'code' => 'MY', 'currency' => 'MYR'],
            ['name' => 'Thailand', 'code' => 'TH', 'currency' => 'THB'],
            ['name' => 'Indonesia', 'code' => 'ID', 'currency' => 'IDR'],
            ['name' => 'Philippines', 'code' => 'PH', 'currency' => 'PHP'],
            ['name' => 'Vietnam', 'code' => 'VN', 'currency' => 'VND'],
            ['name' => 'Taiwan', 'code' => 'TW', 'currency' => 'TWD'],
            ['name' => 'Hong Kong', 'code' => 'HK', 'currency' => 'HKD'],
            ['name' => 'Macau', 'code' => 'MO', 'currency' => 'MOP'],
            ['name' => 'Bangladesh', 'code' => 'BD', 'currency' => 'BDT'],
            ['name' => 'Sri Lanka', 'code' => 'LK', 'currency' => 'LKR'],
            ['name' => 'Nepal', 'code' => 'NP', 'currency' => 'NPR'],
            ['name' => 'Bhutan', 'code' => 'BT', 'currency' => 'BTN'],
            ['name' => 'Myanmar', 'code' => 'MM', 'currency' => 'MMK'],
            ['name' => 'Cambodia', 'code' => 'KH', 'currency' => 'KHR'],
            ['name' => 'Laos', 'code' => 'LA', 'currency' => 'LAK'],
            ['name' => 'Brunei', 'code' => 'BN', 'currency' => 'BND'],
            ['name' => 'Maldives', 'code' => 'MV', 'currency' => 'MVR'],
            ['name' => 'New Zealand', 'code' => 'NZ', 'currency' => 'NZD'],
            ['name' => 'Fiji', 'code' => 'FJ', 'currency' => 'FJD'],
            ['name' => 'Papua New Guinea', 'code' => 'PG', 'currency' => 'PGK'],
            
            // Africa
            ['name' => 'South Africa', 'code' => 'ZA', 'currency' => 'ZAR'],
            ['name' => 'Nigeria', 'code' => 'NG', 'currency' => 'NGN'],
            ['name' => 'Kenya', 'code' => 'KE', 'currency' => 'KES'],
            ['name' => 'Morocco', 'code' => 'MA', 'currency' => 'MAD'],
            ['name' => 'Tunisia', 'code' => 'TN', 'currency' => 'TND'],
            ['name' => 'Algeria', 'code' => 'DZ', 'currency' => 'DZD'],
            ['name' => 'Libya', 'code' => 'LY', 'currency' => 'LYD'],
            ['name' => 'Sudan', 'code' => 'SD', 'currency' => 'SDG'],
            ['name' => 'Ethiopia', 'code' => 'ET', 'currency' => 'ETB'],
            ['name' => 'Ghana', 'code' => 'GH', 'currency' => 'GHS'],
            ['name' => 'Tanzania', 'code' => 'TZ', 'currency' => 'TZS'],
            ['name' => 'Uganda', 'code' => 'UG', 'currency' => 'UGX'],
            ['name' => 'Rwanda', 'code' => 'RW', 'currency' => 'RWF'],
            ['name' => 'Senegal', 'code' => 'SN', 'currency' => 'XOF'],
            ['name' => 'Ivory Coast', 'code' => 'CI', 'currency' => 'XOF'],
            ['name' => 'Mali', 'code' => 'ML', 'currency' => 'XOF'],
            ['name' => 'Burkina Faso', 'code' => 'BF', 'currency' => 'XOF'],
            ['name' => 'Niger', 'code' => 'NE', 'currency' => 'XOF'],
            ['name' => 'Guinea', 'code' => 'GN', 'currency' => 'GNF'],
            ['name' => 'Sierra Leone', 'code' => 'SL', 'currency' => 'SLL'],
            ['name' => 'Liberia', 'code' => 'LR', 'currency' => 'LRD'],
            ['name' => 'Gambia', 'code' => 'GM', 'currency' => 'GMD'],
            ['name' => 'Guinea-Bissau', 'code' => 'GW', 'currency' => 'XOF'],
            ['name' => 'Cape Verde', 'code' => 'CV', 'currency' => 'CVE'],
            ['name' => 'Mauritania', 'code' => 'MR', 'currency' => 'MRU'],
            ['name' => 'Chad', 'code' => 'TD', 'currency' => 'XAF'],
            ['name' => 'Central African Republic', 'code' => 'CF', 'currency' => 'XAF'],
            ['name' => 'Cameroon', 'code' => 'CM', 'currency' => 'XAF'],
            ['name' => 'Equatorial Guinea', 'code' => 'GQ', 'currency' => 'XAF'],
            ['name' => 'Gabon', 'code' => 'GA', 'currency' => 'XAF'],
            ['name' => 'Republic of Congo', 'code' => 'CG', 'currency' => 'XAF'],
            ['name' => 'Democratic Republic of Congo', 'code' => 'CD', 'currency' => 'CDF'],
            ['name' => 'Angola', 'code' => 'AO', 'currency' => 'AOA'],
            ['name' => 'Zambia', 'code' => 'ZM', 'currency' => 'ZMW'],
            ['name' => 'Zimbabwe', 'code' => 'ZW', 'currency' => 'ZWL'],
            ['name' => 'Botswana', 'code' => 'BW', 'currency' => 'BWP'],
            ['name' => 'Namibia', 'code' => 'NA', 'currency' => 'NAD'],
            ['name' => 'Lesotho', 'code' => 'LS', 'currency' => 'LSL'],
            ['name' => 'Swaziland', 'code' => 'SZ', 'currency' => 'SZL'],
            ['name' => 'Madagascar', 'code' => 'MG', 'currency' => 'MGA'],
            ['name' => 'Mauritius', 'code' => 'MU', 'currency' => 'MUR'],
            ['name' => 'Seychelles', 'code' => 'SC', 'currency' => 'SCR'],
            ['name' => 'Comoros', 'code' => 'KM', 'currency' => 'KMF'],
            ['name' => 'Djibouti', 'code' => 'DJ', 'currency' => 'DJF'],
            ['name' => 'Somalia', 'code' => 'SO', 'currency' => 'SOS'],
            ['name' => 'Eritrea', 'code' => 'ER', 'currency' => 'ERN'],
            ['name' => 'Malawi', 'code' => 'MW', 'currency' => 'MWK'],
            ['name' => 'Mozambique', 'code' => 'MZ', 'currency' => 'MZN'],
            
            // Americas
            ['name' => 'Mexico', 'code' => 'MX', 'currency' => 'MXN'],
            ['name' => 'Brazil', 'code' => 'BR', 'currency' => 'BRL'],
            ['name' => 'Argentina', 'code' => 'AR', 'currency' => 'ARS'],
            ['name' => 'Chile', 'code' => 'CL', 'currency' => 'CLP'],
            ['name' => 'Colombia', 'code' => 'CO', 'currency' => 'COP'],
            ['name' => 'Peru', 'code' => 'PE', 'currency' => 'PEN'],
            ['name' => 'Venezuela', 'code' => 'VE', 'currency' => 'VES'],
            ['name' => 'Ecuador', 'code' => 'EC', 'currency' => 'USD'],
            ['name' => 'Bolivia', 'code' => 'BO', 'currency' => 'BOB'],
            ['name' => 'Paraguay', 'code' => 'PY', 'currency' => 'PYG'],
            ['name' => 'Uruguay', 'code' => 'UY', 'currency' => 'UYU'],
            ['name' => 'Guyana', 'code' => 'GY', 'currency' => 'GYD'],
            ['name' => 'Suriname', 'code' => 'SR', 'currency' => 'SRD'],
            ['name' => 'French Guiana', 'code' => 'GF', 'currency' => 'EUR'],
            ['name' => 'Costa Rica', 'code' => 'CR', 'currency' => 'CRC'],
            ['name' => 'Panama', 'code' => 'PA', 'currency' => 'PAB'],
            ['name' => 'Nicaragua', 'code' => 'NI', 'currency' => 'NIO'],
            ['name' => 'Honduras', 'code' => 'HN', 'currency' => 'HNL'],
            ['name' => 'El Salvador', 'code' => 'SV', 'currency' => 'USD'],
            ['name' => 'Guatemala', 'code' => 'GT', 'currency' => 'GTQ'],
            ['name' => 'Belize', 'code' => 'BZ', 'currency' => 'BZD'],
            ['name' => 'Cuba', 'code' => 'CU', 'currency' => 'CUP'],
            ['name' => 'Jamaica', 'code' => 'JM', 'currency' => 'JMD'],
            ['name' => 'Haiti', 'code' => 'HT', 'currency' => 'HTG'],
            ['name' => 'Dominican Republic', 'code' => 'DO', 'currency' => 'DOP'],
            ['name' => 'Puerto Rico', 'code' => 'PR', 'currency' => 'USD'],
            ['name' => 'Trinidad and Tobago', 'code' => 'TT', 'currency' => 'TTD'],
            ['name' => 'Barbados', 'code' => 'BB', 'currency' => 'BBD'],
            ['name' => 'Bahamas', 'code' => 'BS', 'currency' => 'BSD'],
            ['name' => 'Antigua and Barbuda', 'code' => 'AG', 'currency' => 'XCD'],
            ['name' => 'Saint Kitts and Nevis', 'code' => 'KN', 'currency' => 'XCD'],
            ['name' => 'Saint Lucia', 'code' => 'LC', 'currency' => 'XCD'],
            ['name' => 'Saint Vincent and the Grenadines', 'code' => 'VC', 'currency' => 'XCD'],
            ['name' => 'Grenada', 'code' => 'GD', 'currency' => 'XCD'],
            ['name' => 'Dominica', 'code' => 'DM', 'currency' => 'XCD'],
            
            // Additional European Countries
            ['name' => 'Russia', 'code' => 'RU', 'currency' => 'RUB'],
            ['name' => 'Ukraine', 'code' => 'UA', 'currency' => 'UAH'],
            ['name' => 'Belarus', 'code' => 'BY', 'currency' => 'BYN'],
            ['name' => 'Moldova', 'code' => 'MD', 'currency' => 'MDL'],
            ['name' => 'Serbia', 'code' => 'RS', 'currency' => 'RSD'],
            ['name' => 'Montenegro', 'code' => 'ME', 'currency' => 'EUR'],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BA', 'currency' => 'BAM'],
            ['name' => 'North Macedonia', 'code' => 'MK', 'currency' => 'MKD'],
            ['name' => 'Albania', 'code' => 'AL', 'currency' => 'ALL'],
            ['name' => 'Kosovo', 'code' => 'XK', 'currency' => 'EUR'],
            ['name' => 'Iceland', 'code' => 'IS', 'currency' => 'ISK'],
            ['name' => 'Liechtenstein', 'code' => 'LI', 'currency' => 'CHF'],
            ['name' => 'Monaco', 'code' => 'MC', 'currency' => 'EUR'],
            ['name' => 'San Marino', 'code' => 'SM', 'currency' => 'EUR'],
            ['name' => 'Vatican City', 'code' => 'VA', 'currency' => 'EUR'],
            ['name' => 'Andorra', 'code' => 'AD', 'currency' => 'EUR'],
        ];

        // Currencies
        $currencies = [
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Pakistani Rupee', 'code' => 'PKR', 'symbol' => 'Rs'],
            ['name' => 'British Pound', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => 'C$'],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => 'A$'],
        ];

        // Units
        $units = [
            ['name' => 'Pieces', 'code' => 'PCS', 'description' => 'Individual pieces'],
            ['name' => 'Kilograms', 'code' => 'KG', 'description' => 'Weight in kilograms'],
            ['name' => 'Boxes', 'code' => 'BOX', 'description' => 'Boxes'],
            ['name' => 'Cartons', 'code' => 'CARTON', 'description' => 'Cartons'],
            ['name' => 'Pallets', 'code' => 'PALLET', 'description' => 'Pallets'],
        ];

        // Branches
        $branches = [
            ['name' => 'Karachi', 'code' => 'KHI', 'city' => 'Karachi'],
            ['name' => 'Lahore', 'code' => 'LHR', 'city' => 'Lahore'],
            ['name' => 'Islamabad', 'code' => 'ISB', 'city' => 'Islamabad'],
            ['name' => 'Quetta', 'code' => 'QTA', 'city' => 'Quetta'],
            ['name' => 'Peshawar', 'code' => 'PSH', 'city' => 'Peshawar'],
        ];

        // Insert data
        foreach ($services as $service) {
            DB::table('services')->updateOrInsert(
                ['code' => $service['code']],
                $service
            );
        }

        foreach ($countries as $country) {
            DB::table('countries')->updateOrInsert(
                ['code' => $country['code']],
                $country
            );
        }

        foreach ($currencies as $currency) {
            DB::table('currencies')->updateOrInsert(
                ['code' => $currency['code']],
                $currency
            );
        }

        foreach ($units as $unit) {
            DB::table('units')->updateOrInsert(
                ['code' => $unit['code']],
                $unit
            );
        }

        foreach ($branches as $branch) {
            DB::table('branches')->updateOrInsert(
                ['code' => $branch['code']],
                $branch
            );
        }

        echo "Static data seeded successfully!\n";
    }
}



