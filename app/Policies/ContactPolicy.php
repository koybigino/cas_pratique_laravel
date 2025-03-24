<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactPolicy
{
    public function envoyer(User $user): bool
    {
        return $user->role == "user";
    }
}
