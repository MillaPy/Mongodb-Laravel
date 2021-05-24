<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Jenssegers\Mongodb\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
//use Laravel\Scout\Searchable;

class Teacher extends Eloquent
{
    protected $connection = 'mongodb';

    use HasFactory;

    protected $fillable=[
        'teacher_id',
        'fullname', 'email', 'phone', 'gender',
        'address', 'date_of_birth', 'degree', //phd, master, bachelor
        'speciality', //cs, management, finance, iis
        'awards_amount',
    ];

    protected $casts=[
        'teacher_id' => 'string',
    ];
}
