<?php

namespace App\Livewire;

use App\Models\ExaminationResult;
use App\Models\StudentAcademicDetail;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

class FlushImports extends Component
{
    public function render()
    {
        return view('livewire.flush-imports');
    }

    // Located at ApplicationTable
    public function flush()
        {
            $flush_start_time = date('d M Y h:i:s');
            DB::transaction(function(){
                // Delete the student profile record
                $ids = StudentProfile::where('imported', 'yes')->get();
    
                foreach ($ids as $key => $value) {
                    $profile_id = $value['id'];
                    // Delete the associated student profile id record
                    StudentProfile::where('id', $profile_id)->delete();

                    // Delete the associated student course registration record
                    StudentCourseRegistration::where('student_profile_id', $profile_id)->delete();
        
                    // Delete the associated student academic detail record
                    StudentAcademicDetail::where('student_profile_id', $profile_id)->delete();

                    // Delete Register & Examination Records
                    $student_register = StudentRegister::where('student_profile_id', $profile_id)->first();
                    if ($student_register != null) {
                        ExaminationResult::where('student_id', $student_register->student_id)->delete();
                        $student_register->delete();
                    }

                }
                
            });

            // Log
            $data = [
                "effect"=>"Deleted Students",
                "start_time" => $flush_start_time,
                "end_time"=> date('d M Y h:i:s')
            ];
            $json = Storage::disk('public')->get('logs/.imports-YChdyIOAkduVCYsuOPsk192K');
            $json = json_decode($json, true);
            $json[Auth::User()->email.'_'.time()] = $data;

            Storage::disk('public')->put('logs/.imports-YChdyIOAkduVCYsuOPsk192K', json_encode($json));

            $this->dispatch(
                'application_alert',
                type: 'success',
                title: 'Flushed',
                footer: 'Removed All Student Imports',
                position: 'center',
                timer: 1500
            );
        }
}
