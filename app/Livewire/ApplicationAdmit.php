<?php

namespace App\Livewire;

use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Null_;

class ApplicationAdmit extends Component
{
    public $id;
    public $student_id=0;
    public $student_info;
    public $student_ac;
    public $dtef_status;
    public $passport_number;
    public $omang;

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

        // Prepare DTEF columns
        if ($this->student_info->sponsor === 'dtef'){
            $this->dtef_status = 'pending';
        }
        else {
            $this->dtef_status = null;
        }

        // Prepare Omang & Passport Number
        if ($this->student_info->omang == null) {
            $this->omang = null;
            $this->passport_number = $this->student_info->passport_number;
        }
        else {
            $this->omang = $this->student_info->omang;
            $this->passport_number = null;
        }

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
                    'tr_number'=>time(),
                    'program_code'=> $this->student_info->course_code,
                    'program_description'=>$this->student_info->course_name,
                    'year_of_study'=> $this->student_info->level_of_entry,
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
                    //'sponsor_code'=>'',
                    'sponsor'=>$this->student_info->sponsor,
                    'accomodation_status'=>'off',
                    'campus'=>'Gaborone',
                    'dtef_register'=>$this->dtef_status,
                    'dtef_result'=>$this->dtef_status,
                    'dtef_admission'=>$this->dtef_status

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

        // Log
        $data = [
            "affected_user" => $student->email,
            "effect"=>"Admitted",
            "time" => date('d M Y h:i:s')
        ];
        $json = Storage::disk('public')->get('logs/.applications-xcUSosUQIDYVsjsjcuSYq');
        $json = json_decode($json, true);
        $json[Auth::User()->email.'_'.time()] = $data;

        Storage::disk('public')->put('logs/.applications-xcUSosUQIDYVsjsjcuSYq', json_encode($json));

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
