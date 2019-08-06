<?php

namespace App\Http\Controllers;

use App\Team;

use Illuminate\Http\Request;

class TeamController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Team::class);
        $auth = $request->validate([
            'teamName' =>'required',
            'leadUser_id' =>'required',
        ]);
        $team = new Team;
        $team->create($auth);
        return "Team Created!!";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $this->authorize('view',$team);
        return $team;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->authorize('update',$team);
        $auth =$request->validate([
            'teamName' => 'required',
            'leadUser_id' => 'required'
        ]);
        $team->update($auth);
        return "Team Updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }

    public function showMember(Team $team)
    {
        $this->authorize('showMember',$team);
        $teamMember = $team->users;
        return $teamMember->map->only(['name']);
    }
    public function showProject(Team $team)
    {
        $this->authorize('showProject',$team);
        $teamProject = $team->projects;
        $teamProjectName = $teamProject->map->only(['name']);
        return $teamProjectName;
    }
}
