<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

  
     
    public function getJWTCustomClaims()
    {
        return [];
    }

   
    protected $guarded = [];

  
    protected $hidden = [
        'password', 'remember_token',
    ];

   
}
