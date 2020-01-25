<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $guarded = [];

    public function subevent()
    {
    	return $this->belongsToMany('App\SubEvent');
    }

    public function fullName()
    {
    	return $this->f_name .' '.$this->l_name;
    }
}
