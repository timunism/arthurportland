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
        'student_profile_id',
        'application_fee_receipt',
        'student_id_number',
        'course_id',
        'level_of_entry',
        'sponsor',
        'paper',
        'start_date',
        'completion_date',
    ];
}
