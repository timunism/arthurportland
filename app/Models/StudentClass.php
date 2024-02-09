<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = 'student_classes';

    protected $fillable = [
        'course_id',
        'paper',
        'student_profile_id',
        'year',
        'intake',
        'semester'
    ];
}
