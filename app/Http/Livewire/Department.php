<?php

namespace App\Http\Livewire;

use App\Models\Section;
use Livewire\Component;

class Department extends Component
{
    public $departments;
    public $sections;
    public $selectedDepartment;

    public function mount($departments)
    {
        $this->departments = $departments;
        $this->sections = collect();
    }

    public function updatedSelectedDepartment($value)
    {
        $this->sections = Section::where('department_id',$value)->get();
    }


    public function render()
    {
        return view('livewire.department');
    }
}
