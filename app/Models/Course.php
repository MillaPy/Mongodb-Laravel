<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
//use Jenssegers\Mongodb\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Course extends Eloquent
{
    use HasFactory;
    use SearchableTrait;
    use HybridRelations;

    protected $connection = 'mongodb';

    protected $fillable=[
        'course_id', 'title', 'course_code',
        'description', 'duration', 'ects',
    ];

    protected $searchable = [
            'title',
            'description',
            'course_id',
    ];

    protected $casts=[
        'course_id' => 'string',
    ];

}
