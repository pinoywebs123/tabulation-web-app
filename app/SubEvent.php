<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    public function criterias()
    {
        return $this->belongsToMany('App\Critera', 'subevent_criteria_judge', 'evnt_id_FK', 'svnt_id_FK');
    }
}
