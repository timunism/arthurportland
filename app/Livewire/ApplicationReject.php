<?php

namespace App\Livewire;

use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ApplicationReject extends Component
{
    public $id;
    public function reject($id) {
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
        DB::transaction(function(){
            DB::table('student_course_registration')
            ->where('student_profile_id', $this->id)
            ->update(['registration_status'=>'rejected']);
        });

        // Send eMail Notification to Student
        $student = StudentProfile::where('id', $id)->first();
        $email_status = "";
        try {
        $email_data = [
            // pass student data to applications.mail-admitted view
            'student' => $student,
        ];

        Mail::send('applications.mail-rejected', $email_data, function ($message) use ($student){
            $message->to($student->email)->subject('Application Rejected');
        });
        $email_status = 'Rejection Letter Sent';
        } catch (\Throwable $th) {
        // do nothing...for now
            $email_status = 'Rejection Letter Not Sent';
        }

        // Log
        $data = [
            "affected_user" => $student->email,
            "effect"=>"Rejected",
            "time" => date('d M Y h:i:s')
        ];
        $json = Storage::disk('public')->get('logs/.applications-xcUSosUQIDYVsjsjcuSYq');
        $json = json_decode($json, true);
        $json[Auth::User()->email.'_'.time()] = $data;

        Storage::disk('public')->put('logs/.applications-xcUSosUQIDYVsjsjcuSYq', json_encode($json));

        $this->dispatch(
            'application_alert',
            type: 'success',
            title: 'Rejected',
            footer: $email_status,
            position: 'center',
            timer: 1500
        );
    }

    public function render()
    {
        return view('livewire.application-reject');
    }
}
