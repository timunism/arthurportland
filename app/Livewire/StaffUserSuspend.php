<?php

namespace App\Livewire;

use App\Models\StaffProfile;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class StaffUserSuspend extends Component
{
    public $id;
    public $email;
    public function suspend($id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        // restrict unauthorized access
        if (!Auth::User()->access == 'unrestricted'){
            abort(403, $message='You are not authorized to perform this action');
        }
        $staff_member = StaffProfile::where('id', $id)->first();
        $this->email = $staff_member->email;

        DB::transaction(function(){
            DB::table('users')
                ->where('email', $this->email)
                ->update(['status'=>'suspended']);
        });

        // Send eMail Notification to Student
        $this->dispatch(
            'application_alert',
            type: 'success',
            title: 'Account Suspended',
            footer: $this->email.' has been suspended.',
            position: 'center',
            timer: 1500
        );
    }

    public function render()
    {
        return view('livewire.staff-user-suspend');
    }
}
