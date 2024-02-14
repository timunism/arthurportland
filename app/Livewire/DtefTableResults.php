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

    public function render()
    {
        $dtefStudents = StudentRegister::where('sponsor', 'Dept Of Tertiary Education Financing')
        ->search($this->search)
        ->when($this->year !== '', function($query){
            $query->where('year_of_study',$this->year);
        })
        ->paginate($this->perPage);

        return view('livewire.dtef-table-results', [
            'students' => $dtefStudents,
            'year'=>$this->year,
        ]);
    }
}
