<?php

namespace App\Http\Controllers;

use App\User;
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
        return "User Registered";
    }

    public function update(Request $request, User $user)
    {
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
}
