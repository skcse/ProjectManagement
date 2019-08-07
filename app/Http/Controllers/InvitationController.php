<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\Mail\Welcome;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {

    }

    public function store(Project $project, User $user, Request $request)
    {
        $this->authorize('create',Invitation::class);
        $this->authorize('view',$project);
        $invite = new Invitation();
        $invite->receiver_id = $user->id;
        $invite->sender_id = auth()->user()->id;
        $invite->project_id = $project->id;
        $invite->save();
        \Mail::to($user)->send(new Welcome);
        return "Invited!!";
    }

    public function show(Invitation $invitation)
    {
        //
    }

    public function edit(Invitation $invitation)
    {
        //
    }

    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    public function destroy(Invitation $invitation)
    {

    }

    public function accept_invitation(Invitation $invitation)
    {
        $this->authorize('view',$invitation);
        $user=auth()->user();

        $invitation->status='accepted';
        $invitation->save();
        $user->projects()->attach($invitation->project_id);
        return "Invitation accepted!!";
    }

    public function reject_invitation(Invitation $invitation)
    {
        $this->authorize('view',$invitation);
        $user=auth()->user();

        $invitation->status='rejected';
        $invitation->save();
        return "Invitation reject!!";
    }

    public function showInvitations()
    {
        $user = auth()->user();
        return response()->json(['Invitations' => $user->invitations]);
    }
}
