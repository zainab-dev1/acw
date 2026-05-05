<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ActivityType extends Component
{
    public $visit_activity_types;

    public $selectedActivityType;

    public $show_link = false;

    public function mount($visit_activity_types)
    {
        $this->$visit_activity_types = $visit_activity_types;    
        $this->show_link = false;
    }
    public function render()
    {
        return view('livewire.activity-type');
    }

    public function updatedSelectedActivityType($value)
    {
        $this->show_link = false;
        if ($value ==1)
        {
            $this->show_link = true;
        }
    }
}
