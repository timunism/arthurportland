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
    public $admission = '';
    public $course_code = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function setSortBy($field){
        if ($this->sortBy === $field){
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $field;
        $this->sortDir = 'DESC';
    }

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
        ->when($this->admission != '', function($query) {
            $query->where('registration_status', $this->admission);
        })
        ->when($this->course_code != '', function($query) {
            $query->where('course_code', $this->course_code);
        })
        ->orderBy('student_profile.'.$this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.applications-table', [
            'students' => $students
        ]);
    }
}
