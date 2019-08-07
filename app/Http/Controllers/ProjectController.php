<?php

namespace App\Http\Controllers;

use App\Project;
use App\Projectmember;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('view',$project);
        return $project;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
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
//        dd(auth()->user()->team_id);
        $this->authorize('showMember',$project);
        $users = $project->users;
        $usersName =$users->map->only(['name']);
        return $usersName;
    }


//    public function addMember(Project $project, Request $request)
//    {
//        $this->authorize('addMember',$project);
//        $auth = $request->validate([
//            'user_id'=> 'required'
//        ]);
//        $projectmember = new Projectmember([
//            'user_id'=>$auth['user_id'],
//            'project_id'=>$project->id,
//        ]);
//        $projectmember->save();
//        return "Project member mapped";
//    }
//    public function showMember(Project $project)
//    {
////        dd(auth()->user()->team_id);
//        $this->authorize('showMember',$project);
//        $projectmember = Projectmember::all();
//        return $projectmember;
//    }
}
