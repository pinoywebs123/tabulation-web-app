<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function subevents()
    {
        return $this->belongsToMany('App\SubEvent', 'event_subevent', 'evnt_id_FK', 'svnt_id_FK');
    }

    public function candidates()
    {
        return $this->belongsToMany('App\Candidate', 'event_candidate', 'evnt_id_FK', 'cdt_id_FK');
    }
}
