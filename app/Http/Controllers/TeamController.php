<?php

namespace App\Http\Controllers;

use App\Team;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->authorize('create',Team::class);
        $auth = $request->validate([
            'name' =>'required',
            'leadUser_id' =>'required',
        ]);
        $team = new Team;
        $team->create($auth);
        return "Team Created!! ";
    }

    public function show(Team $team)
    {
        $this->authorize('view',$team);
        return $team;
    }

    public function edit(Team $team)
    {
        //
    }

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
