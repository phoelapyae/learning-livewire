<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $name = '';
    public $about = '';
    // public $saved = false;

    // protected $listeners = ['notify-saved'];

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->about = auth()->user()->about;
    }

    public function save()
    {
        $profileData = $this->validate([
            'name' => 'required|max:24',
            'about' => 'required|max:140'
        ]);

        auth()->user()->update($profileData);

        $this->emitSelf('notify-saved');

        // session()->flash('notify-saved');

        // $this->dispatchBrowserEvent('notify', 'Profile saved!');
    }

    // public function updated($field)
    // {
    //     if ($field !== 'saved') {
    //         $this->saved = false;
    //     }
    // }

    // public function setAsUnsave()
    // {
    //     $this->saved = false;
    // }

    public function render()
    {
        return view('livewire.profile')->layout('layouts.app');
    }
}
