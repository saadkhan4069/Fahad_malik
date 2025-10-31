<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Label;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

    public function view($user, Label $label)
    {
        if ($user instanceof Company) {
            return $user->id === $label->company_id;
        } elseif ($user instanceof User) {
            return $user->company_id === $label->company_id;
        }
        return false;
    }

    public function update($user, Label $label)
    {
        if ($user instanceof Company) {
            return $user->id === $label->company_id;
        } elseif ($user instanceof User) {
            return $user->company_id === $label->company_id;
        }
        return false;
    }
}