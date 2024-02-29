<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentRegister;

class DtefTableResults extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = '';
    public $year = '';
    public $submission = '';
    public $course_code = '';
    public $sortBy = 'student_register.created_at';
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
        $dtefStudents = StudentRegister::join('student_profile',
        'student_register.student_profile_id', '=', 'student_profile.id')
        ->where('sponsor', 'dtef')
        ->search($this->search)
        ->when($this->year !== '', function($query){
            $query->where('year_of_study',$this->year);
        })
        ->when($this->submission !== '', function($query){
            $query->where('dtef_result',$this->submission);
        })
        ->when($this->course_code !== '', function($query){
            $query->where('program_code',$this->course_code);
        })
        ->orderBy($this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.dtef-table-results', [
            'students' => $dtefStudents,
            'year'=>$this->year,
        ]);
    }
}
