<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
	protected $table = 'subevents';
	protected $guarded = [];

    public function event()
    {
        return $this->belongsToMany('App\Event')->withPivot('status_id');
    }

    public function criterias()
    {
    	return $this->hasMany('App\Criteria');
    }

    public function candidate()
    {
        return $this->belongsToMany('App\Candidate');
    }

   
}
