<?php

namespace App\Http\Controllers;

use App\Project;
use App\Projectmember;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $this->authorize('create',Project::class);
        $auth = $request->validate([
            'name'=> 'required',
            'description'=>'required'
        ]);
        $project = new Project([
            'name'=> $auth['name'],
            'team_id'=> $user->team_id,
            'description' =>$auth['description']
        ]);
        $project->save();
        return "Project Created!";
    }


    public function show(Project $project)
    {
        $this->authorize('view',$project);
        return $project;
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update',$project);
        $auth =$request->validate([
           'name'=>'required',
            'description'=>'required'
        ]);
        $project->update($auth);
        return "Project details Update!";
    }

    public function destroy(Project $project)
    {
        //
    }

    public function addMember(Project $project, Request $request)
    {
        $user=auth()->user();
        $this->authorize('addMember',$project);

        $auth = $request->validate([
            'user_id'=> 'required'
        ]);
        $user_add = User::findOrFail($auth['user_id']);
        if($user->team_id != $user_add->team_id)
            return redirect('/api/invite/' . $project->id . '/' . $auth['user_id']);
        $project->users()->attach($auth['user_id']);
        return "member added";
    }

    public function showMember(Project $project)
    {
        $this->authorize('showMember',$project);
        $users = $project->users;
        $usersName =$users->map->only(['name']);
        return $usersName;
    }
}
