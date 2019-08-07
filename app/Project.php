<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'project_id', 'id');
    }

}
