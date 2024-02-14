<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCoursePaper extends Model
{
    use HasFactory;

    protected $table = "student_course_papers";
    protected $fillable = [
        'paper_name'
    ];
}
