<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function view($user, Invoice $invoice)
    {
        if ($user instanceof Company) {
            return $user->id === $invoice->company_id;
        } elseif ($user instanceof User) {
            return $user->company_id === $invoice->company_id;
        }
        return false;
    }

    public function update($user, Invoice $invoice)
    {
        if ($user instanceof Company) {
            return $user->id === $invoice->company_id;
        } elseif ($user instanceof User) {
            return $user->company_id === $invoice->company_id;
        }
        return false;
    }
}
