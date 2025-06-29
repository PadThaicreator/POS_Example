<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{   
    use HasFactory;
    //

    protected $table ='user';
    public $timestamps = false;
    protected $fillable = [
        'firstName',
        'lastName',
        'nickname',
        'phoneNumber',
        'birthDay',
        'role',
        'status'
    ];
}
