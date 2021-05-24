<?php

namespace App\Http\Livewire\Admin\Teacher;

use App\Models\Teacher;
use Livewire\Component;

class Single extends Component
{

    public $teacher;

    public function mount(Teacher $teacher){
        $this->teacher = $teacher;
    }

    public function delete()
    {
        $this->teacher->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Teacher') ]) ]);
        $this->emit('teacherDeleted');
    }

    public function render()
    {
        return view('livewire.admin.teacher.single')
            ->layout('admin::layouts.app');
    }
}
