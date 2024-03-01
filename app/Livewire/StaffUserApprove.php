<?php

namespace App\Livewire;

use App\Models\StaffProfile;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class StaffUserApprove extends Component
{
    public $id;
    public $user;
    public $password="";

    public function approve($id) {
        if (Auth::User()) {
            if(Auth::User()->status != 'active') {
                abort(403, 'You have been logged out by the admin');
            }
        }
        // restrict unauthorized access
        if (
            Auth::User()->access != 'unrestricted' &&
            Auth::User()->access != 'admissions'
            ){
            abort(403, $message='You are not authorized to perform this action');
        }
        $user = StaffProfile::where('staff_profile.id', $this->id)
            ->join('user_roles',
            'staff_profile.role', '=', 'user_roles.role')
            ->first();

        $this->user = $user;
        $this->id = $id;

        // unsecure password generatio
        $passWordPool = [
            'p', 'm', 'c', 'E', 'd', '*', '&', '1', '2', 'Z', '9', 'r',
            'A', 'B', 'C', 'Q', 'n', 'S', 'r', 'i', 'c', 'B'
        ];

        for ($i=0; $i < 12; $i++) { 
            $this->password = $this->password.$passWordPool[random_int(0, count($passWordPool)-1)];
        }
        DB::transaction(function(){
            DB::table('staff_profile')
            ->where('id', $this->id)
            ->update(['approval'=>'approved']);

            DB::table('users')->insert([
                'fullname'=>$this->user->fullname,
                'surname'=>$this->user->surname,
                'email'=>$this->user->email,
                'role'=>$this->user->role,
                'access'=>$this->user->access,
                'password'=>Hash::make($this->password),
            ]);
        });
        $data = [
            'alert'=>'success',
            'email'=>$this->user->email,
            'password'=>$this->password,
        ];

        $this->dispatch(
            'staff_application_alert',
            type: 'success',
            title: 'Profile Approved',
            footer: 'Password: '.$this->password,
            position: 'center',
            timer: false
        );
    }

    public function render()
    {
        return view('livewire.staff-user-approve');
    }
}
