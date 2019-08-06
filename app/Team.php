<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded =[];
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
