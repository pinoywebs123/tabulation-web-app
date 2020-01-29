<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    public function fullName()
    {
    	return $this->f_name .' '.$this->l_name;
    }
}
