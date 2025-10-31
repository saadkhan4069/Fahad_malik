<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Shipment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShipmentPolicy
{
    use HandlesAuthorization;

    public function view($user, Shipment $shipment)
    {
        if ($user instanceof Company) {
            return $user->id === $shipment->company_id;
        } elseif ($user instanceof User) {
            return $user->company_id === $shipment->company_id;
        }
        return false;
    }

    public function update($user, Shipment $shipment)
    {
        if ($user instanceof Company) {
            return $user->id === $shipment->company_id;
        } elseif ($user instanceof User) {
            return $user->company_id === $shipment->company_id;
        }
        return false;
    }

    public function delete($user, Shipment $shipment)
    {
        if ($user instanceof Company) {
            return $user->id === $shipment->company_id && $shipment->status === 'pending';
        } elseif ($user instanceof User) {
            return $user->company_id === $shipment->company_id && $shipment->status === 'pending';
        }
        return false;
    }
}
