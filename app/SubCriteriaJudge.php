<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Criteria;

class SubCriteriaJudge extends Model
{
    protected $table = 'subevent_criteria_judge';

    public function candidate(){
    	return $this->hasOne('App\Candidate');
    }

    public function criteria($criteria_id){
    	return Criteria::findOrFail($criteria_id);
    }
}
