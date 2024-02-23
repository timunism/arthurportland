<?php

namespace App\Livewire;

use App\Models\FacultyProfile;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FacultyUserDeactivate extends Component
{
    public $id;
    public $email;
    public function deactivate($id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        // restrict unauthorized access
        if (!Auth::User()->access == 'unrestricted'){
            abort(403, $message='You are not authorized to perform this action');
        }
        $staff_member = FacultyProfile::where('id', $id)->first();
        $this->email = $staff_member->email;

        DB::transaction(function(){
            DB::table('users')
                ->where('email', $this->email)
                ->update(['status'=>'deactivated']);
        });

        // Send eMail Notification to Student
        $this->dispatch(
            'application_alert',
            type: 'success',
            title: 'Account Deactivated',
            footer: $this->email.' has been deactivated.',
            position: 'center',
            timer: 1500
        );
    }

    public function render()
    {
        return view('livewire.faculty-user-deactivate');
    }
}
