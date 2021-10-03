<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $name = '';
    public $about = '';
    public $birthday = null;
    public $newAvatar;
    public $files = [];

    // public $saved = false;

    // protected $listeners = ['notify-saved'];

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->about = auth()->user()->about;
        $this->birthday = optional(auth()->user()->birthday)->format('m/d/Y');
    }

    public function save()
    {
        $profileData = $this->validate([
            'name' => 'required|max:24',
            'about' => 'required|max:140',
            'birthday' => 'required',
            'newAvatar' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $filename = $this->newAvatar->store('/', 'avatars');
        $profileData['avatar'] = $filename;

        auth()->user()->update($profileData);

        $this->emitSelf('notify-saved');

        // session()->flash('notify-saved');

        // $this->dispatchBrowserEvent('notify', 'Profile saved!');
    }

    public function updatedNewAvatar()
    {
        $this->validate([
            'newAvatar' => 'image|max:2048'
        ]);
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
