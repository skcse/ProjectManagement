<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function create(User $user)
    {
//        dd("hi project");
        return $user->role == 1;
    }
    public function update(User $user, Project $project)
    {
        if(($user->team_id == $project->team_id)&&($user->role == 1))
        {
                return true;
        }
        else
        {
            return false;
        }

    }
    public function view(User $user, Project $project)
    {

    }
    public function addMember(User $user, Project $project)
    {
        if(($user->team_id == $project->team_id) && ($user->role ==1) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function showMember(User $user, Project $project)
    {
//        dd("show");
        return $user->team_id == $project->team_id;
    }
}
