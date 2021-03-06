<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\User;
use App\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $auth = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return "User Registered- " . $user->name;
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update',$user);
        if($request->has('role'))
        {
            $user->role = $request['role'];
        }
        if($request->has('team_id'))
        {
            $user->team_id = $request['team_id'];
        }
        $user->save();
        return "User details updated (only role and team_id can be updated by admin)";
    }
    public function userMail(User $user)
    {
            \Mail::to($user)->send(new Welcome);
            return "Mail sent";
    }
    public function projects()
    {
        $user = auth()->user();
        $projects=  $user->projects;
        $projectsName = $projects->map->only(['name']);
        return $projectsName;
    }

    public function invitations(User $user)
    {
        $this->authorize('view',$user);
        $invitations = $user->invitations;
        return $invitations;
    }
    public function invited()
    {
        $user = auth()->user();
        $invited = $user->invited;
        return $invited;
    }
}
