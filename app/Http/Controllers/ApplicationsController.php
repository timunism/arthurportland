<?php

namespace App\Http\Controllers;

use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ApplicationsController extends Controller
{
    public $commit_id;
    public function index() {
      // For Realtime Deactivations
      if (Auth::User()) {
        if(Auth::User()->status != 'active') {
            abort(403, 'You have been logged out by the admin');
          }
      }
      if(
          Auth::User()->access == 'examinations' ||
          Auth::User()->access == 'individual'
          ){
          abort(403, 'You are not authorized to view this page');
        }
        return view('applications.index');
    }


    // much secure than using actual student id
    public function edit($student_profile_id) {
        if(
          Auth::User()->access == 'examinations' ||
          Auth::User()->access == 'individual'
          ){
          abort(403, 'You are not authorized to view this page');
        }

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

    public function admit($id) {
      $this->commit_id = $id;
      DB::transaction(function(){
        $student_course_registration = DB::table('student_course_registration')
                                    ->where('student_profile_id',$this->commit_id)
                                    ->update(['registration_status'=>'admitted']);
      });

      // Send eMail Notification to Student
      $student = StudentProfile::where('id', $id)->first();
      try {
        $email_data = [
            // pass student data to applications.mail-admitted view
            'student' => $student,
        ];
        Mail::send('applications.mail-admitted', $email_data, function ($message) use ($student){
          $message->to($student->email)->subject('Application Notification');
        });
      } catch (\Throwable $th) {
        // do nothing...for now
      }
      return view('applications.index');
    }

}
