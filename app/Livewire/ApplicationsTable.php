<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ApplicationsTable extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $year = '';

    public function render()
    {
        $students = StudentProfile::join('student_course_registration', 
                'student_profile.id', '=', 'student_course_registration.student_profile_id')
        ->join('student_academic_details',
                'student_profile.id', '=', 'student_academic_details.student_profile_id')
        ->join('student_courses',
                'student_course_registration.course_id', '=', 'student_courses.id')
        ->search($this->search)
        ->when($this->year !== '', function($query){
            $query->whereYear('start_date',$this->year);
        })
        ->paginate($this->perPage);

        return view('livewire.applications-table', [
            'students' => $students
        ]);
    }
}
