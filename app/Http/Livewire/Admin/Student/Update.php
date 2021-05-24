<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $student;

    public $title;
    public $content;
    public $image;
    
    protected $rules = [
        'title' => 'required',
        'content' => 'required|min:30',        
    ];

    public function mount(Student $student){
        $this->student = $student;
        $this->title = $this->student->title;
        $this->content = $this->student->content;
        $this->image = $this->student->image;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Student') ]) ]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/articles');
        }

        $this->student->update([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.student.update', [
            'student' => $this->student
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Student') ])]);
    }
}
