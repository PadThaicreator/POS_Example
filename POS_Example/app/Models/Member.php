<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member  extends Authenticatable implements JWTSubject
{   
    use HasFactory;
    //
    use Notifiable;
    protected $table ='user';
    public $timestamps = false;
    protected $fillable = [
        'firstName',
        'lastName',
        'nickname',
        'phoneNumber',
        'birthDay',
        'role',
        'status',
        'password'
    ];


      public function getJWTIdentifier()
    {
        return $this->getKey();
    }

     public function getJWTCustomClaims()
    {
        return [];
    }
}
