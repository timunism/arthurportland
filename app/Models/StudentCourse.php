<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;
    protected $table = 'student_courses';

    protected $fillable = [
        'id',
        'course_name',
        'course_code',
        'course_duration',
        'course_cost'
    ];
}
