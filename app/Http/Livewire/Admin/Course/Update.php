<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $course;

    public $title;
    public $content;
    public $image;
    
    protected $rules = [
        'title' => 'required',
        'content' => 'required|min:30',        
    ];

    public function mount(Course $course){
        $this->course = $course;
        $this->title = $this->course->title;
        $this->content = $this->course->content;
        $this->image = $this->course->image;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Course') ]) ]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/articles');
        }

        $this->course->update([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.course.update', [
            'course' => $this->course
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Course') ])]);
    }
}
