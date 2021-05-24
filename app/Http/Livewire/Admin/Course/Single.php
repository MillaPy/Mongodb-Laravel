<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;

class Single extends Component
{

    public $course;

    public function mount(Course $course){
        $this->course = $course;
    }

    public function delete()
    {
        $this->course->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Course') ]) ]);
        $this->emit('courseDeleted');
    }

    public function render()
    {
        return view('livewire.admin.course.single')
            ->layout('admin::layouts.app');
    }
}
