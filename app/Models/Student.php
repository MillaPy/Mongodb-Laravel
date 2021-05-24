<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Jenssegers\Mongodb\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
//use Laravel\Scout\Searchable;

class Student extends Eloquent
{
    protected $connection = 'mongodb';

    use HasFactory;

    protected $fillable=[
        'student_id','fullname', 'email', 'phone',
        'gender', 'address', 'date_of_birth',
        'career',
    ];

    protected $casts=[
        'student_id' => 'string',
    ];
}
