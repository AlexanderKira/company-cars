<?php

namespace App\Console\Commands\CarBooking;

use App\Models\CarBooking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldCarBookings extends Command
{
    protected $signature = 'app:delete-old-car-bookings';

    protected $description = 'Delete old car bookings based on end_date';

    public function handle(): void
    {
        $oldBookings = CarBooking::where('end_date', '<', Carbon::now())->get();

        foreach ($oldBookings as $booking) {
            $booking->car->booking_status = false;
            $booking->car->save();
            $this->info("Updated booking status to false for booking with ID: {$booking->id}");
            $booking->delete();
            $this->info("Deleted booking with ID: {$booking->id}");
        }

        $this->info('Old bookings deleted successfully.');
    }
}
