<?php

namespace App\Livewire;

use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ApplicationAdmit extends Component
{
    public $id;
    public $student_id=0;
    public $student_info;
    public $student_ac;

    public function admit($id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        // restrict unauthorized access
        if (!Auth::User()->access == 'unrestricted'){
            abort(403, $message='You are not authorized to perform this action');
        }
        $this->id = $id;
        // combine student information
        $student_info = StudentCourseRegistration::where('student_profile_id', $this->id)
        ->join('student_courses',
          'student_course_registration.course_id', '=', 'student_courses.id')
        ->join('student_profile',
          'student_course_registration.student_profile_id', '=', 'student_profile.id')
        ->first();

        $student_academic_details = StudentAcademicDetail::where('student_profile_id', $this->id)->first();
        $this->student_info = $student_info;
        $this->student_ac = $student_academic_details;

        // generate id for new student
        $this->student_id = 1000 + $this->id;
        $this->student_id = date('Y').'PC'.$this->student_id;
        
        DB::transaction(function(){
            DB::table('student_course_registration')
                ->where('student_profile_id',$this->id)
                ->update(['registration_status'=>'admitted']);

            DB::table('student_register')
                ->insert([
                    'student_profile_id'=>$this->student_info->student_profile_id,
                    'student_id'=> $this->student_id,
                    'surname'=> $this->student_info->surname,
                    'fullname'=> $this->student_info->fullname,
                    'gender'=>$this->student_info->gender,
                    'date_of_birth'=>$this->student_info->date_of_birth,
                    'national_id'=>$this->student_info->national_id,
                    'tr_number'=>'1234567',
                    'contact' => $this->student_info->phone,
                    'program_code'=> $this->student_info->course_code,
                    'program_description'=>$this->student_info->course_name,
                    'faculty'=>'',
                    'year_of_study'=> date('Y').'/'.intval(date('Y'))+2,
                    'start_date'=> date('Y').'-08-11',
                    'sem_end_date' => date('Y').'-12-01',
                    'end_date' => intval(intval(date('Y'))+2).'-7-02',
                    'date_of_registration'=>date('Y-m-d'),
                    'subjects_enrolled'=>str_replace(';',' ',$this->student_info->paper),
                    'credit_enrolled'=>random_int(2, 4),
                    'number_of_modules'=>random_int(3, 5),
                    'passed'=>'0',
                    'failed'=>'0',
                    'student_status'=>'active',
                    'sponsorship_status'=>'active',
                    'sponsor_code'=>'',
                    'sponsor'=>$this->student_info->sponsor,
                    'accomodation_status'=>'off',
                    'campus'=>'Gaborone',
                    'dtef_register'=>'0',
                    'dtef_result'=>'0',
                    'dtef_admission'=>'0'

                ]);
        });

        // Send eMail Notification to Student
        $student = StudentProfile::where('id', $id)->first();
        $email_status = "";
        try {
        $email_data = [
            // pass student data to applications.mail-admitted view
            'student' => $student,
        ];
        Mail::send('applications.mail-admitted', $email_data, function ($message) use ($student){
            $message->to($student->email)->subject('Application Admitted');
        });
        $email_status = "Admission Letter Sent";
        } catch (\Throwable $th) {
        // do nothing...for now
        $email_status = "Admission Letter Not Sent";
        }

        $this->dispatch(
            'application_alert',
            type: 'success',
            title: 'Admitted',
            footer: $email_status,
            position: 'center',
            timer: 1500
        );
    }
    public function render()
    {
        return view('livewire.application-admit');
    }
}
