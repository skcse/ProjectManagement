<?php

namespace App\Http\Controllers;

use App\Project;
use App\Projectmember;
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
        ]);
        $project = new Project([
            'name'=> $auth['name'],
            'team_id'=> $user->team_id
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
//        $this->authorize('show',$project);
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
           'name'=>'required'
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
        $this->authorize('addMember',$project);
        $auth = $request->validate([
            'user_id'=> 'required'
        ]);
        $projectmember = new Projectmember([
            'user_id'=>$auth['user_id'],
            'project_id'=>$project->id,
        ]);
        $projectmember->save();
        return "Project member mapped";
    }
    public function showMember(Project $project)
    {
//        dd(auth()->user()->team_id);
        $this->authorize('showMember',$project);
        $projectmember = Projectmember::all();
        return $projectmember;
    }
}
