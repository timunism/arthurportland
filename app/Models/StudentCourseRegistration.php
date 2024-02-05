<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourseRegistration extends Model
{
    use HasFactory;

    protected $table = 'student_course_registration';

    protected $fillable = [
        'id',
        'student_id',
        'course_id',
        'level_of_entry',
        'course_duration',
        'sponsor',
        'paper',
        'start_date',
        'completion_date',
        'course_cost'
    ];
}
