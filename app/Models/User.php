<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model //implements Authenticatable//Contract, CanResetPasswordContract
{
    //use Notifiable;
    use HasFactory;
    use HybridRelations;

    protected  $connection = 'mongodb';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_id' => 'string',
    ];
}
