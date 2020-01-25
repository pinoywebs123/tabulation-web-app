<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $guarded = [];
	
    public function subevents()
    {
        return $this->belongsToMany('App\SubEvent');
    }

    public function candidates()
    {
        return $this->belongsToMany('App\Candidate', 'event_candidate', 'evnt_id_FK', 'cdt_id_FK');
    }
}
