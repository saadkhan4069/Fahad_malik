<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class AddCnNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::whereNull('cn_number')->get();
        
        foreach ($bookings as $index => $booking) {
            $cnNumber = $booking->company_id . str_pad($index + 1, 5, '0', STR_PAD_LEFT);
            $booking->update(['cn_number' => $cnNumber]);
        }
        
        echo "CN numbers added to " . $bookings->count() . " bookings\n";
    }
}



