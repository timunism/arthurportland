<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAcademicDetail extends Model
{
    use HasFactory;

    protected $table = 'student_academic_details';

    protected $fillable = [
        'id',
        'student_id',
        'employer',
        'nature_of_work',
        'highest_qualification',
        'qualifications',
        'school',
        'senior_school',
        'documents'
    ];
}
