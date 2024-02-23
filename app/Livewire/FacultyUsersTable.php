<?php

namespace App\Livewire;

use App\Models\FacultyProfile;
use Livewire\Component;
use App\Models\StudentCourseRegistration;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class FacultyUsersTable extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
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
        $faculty_profiles = FacultyProfile::join('departments', 
                'faculty_profile.department', '=', 'departments.id')
                ->join('student_courses',
                'student_courses.course_name', '=', 'departments.department_name')
        ->search($this->search)
        ->when($this->course_code != '', function($query) {
            $query->where('course_code', $this->course_code);
        })
        ->orderBy('faculty_profile.'.$this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.faculty-users-table', [
            'faculty_users' => $faculty_profiles
        ]);
    }
}
