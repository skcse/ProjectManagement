<?php

namespace App\Policies;

use App\User;
use App\Invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Invitation $invitation)
    {
        return $user->id == $invitation->user->id;
    }

    public function create(User $user)
    {
        return $user->role == 1;
    }
    
}
