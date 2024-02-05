<?php

namespace App\Http\Controllers;

use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use Illuminate\Http\Request;
use App\Models\StudentProfile;

class ApplicationsController extends Controller
{
    public function index() {
        return view('applications.index');
    }

    // much secure than using actual student id
    public function edit($student_profile_id) {

        $student_info = StudentCourseRegistration::where('student_profile_id', $student_profile_id)
        ->join('student_courses',
          'student_course_registration.course_id', '=', 'student_courses.id')
        ->join('student_profile',
          'student_course_registration.student_profile_id', '=', 'student_profile.id')
        ->first();

        $student_academic_detail = StudentAcademicDetail::where('student_profile_id', $student_profile_id)->first();

        return view('applications.edit', [
            'student_info'=>$student_info,
            'student_academic'=>$student_academic_detail
        ]);
    }
}
