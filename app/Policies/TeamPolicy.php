<?php

namespace App\Policies;

use App\User;
use App\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any teams.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function view(User $user, Team $team)
    {
        return $user->team_id == $team->id;
    }

    /**
     * Determine whether the user can create teams.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can update the team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function update(User $user, Team $team)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can delete the team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function delete(User $user, Team $team)
    {
        //
    }

    /**
     * Determine whether the user can restore the team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function restore(User $user, Team $team)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the team.
     *
     * @param  \App\User  $user
     * @param  \App\Team  $team
     * @return mixed
     */
    public function forceDelete(User $user, Team $team)
    {
        //
    }

    public function showMember(User $user, Team $team)
    {
//        dd("show<MM");
        return $user->team_id == $team->id;
    }
    public function showProject(User $user, Team $team)
    {
        return $user->team_id == $team->id;
    }
}
