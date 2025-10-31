<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function view($user, Booking $booking)
    {
        if ($user instanceof Company) {
            return $user->id === $booking->company_id;
        } elseif ($user instanceof User) {
            return $user->id === $booking->user_id;
        }
        return false;
    }

    public function update($user, Booking $booking)
    {
        if ($user instanceof Company) {
            return $user->id === $booking->company_id;
        } elseif ($user instanceof User) {
            return $user->id === $booking->user_id;
        }
        return false;
    }

    public function delete($user, Booking $booking)
    {
        if ($user instanceof Company) {
            return $user->id === $booking->company_id && $booking->status === 'pending';
        } elseif ($user instanceof User) {
            return $user->id === $booking->user_id && $booking->status === 'pending';
        }
        return false;
    }
}
