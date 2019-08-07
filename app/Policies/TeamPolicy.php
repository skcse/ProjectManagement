<?php

namespace App\Policies;

use App\User;
use App\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;
    

    public function view(User $user, Team $team)
    {
        return $user->team_id == $team->id;
    }

    public function create(User $user)
    {
        return $user->role == 2;
    }

    public function update(User $user, Team $team)
    {
        return $user->role == 2;
    }

    public function showMember(User $user, Team $team)
    {
        if($user->role==2)
            return true;
        return $user->team_id == $team->id;
    }
    public function showProject(User $user, Team $team)
    {
        if($user->role==2)
            return true;
        return $user->team_id == $team->id;
    }
}
