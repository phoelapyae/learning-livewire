<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $name = '';
    public $about = '';

    public function save()
    {

        $profileData = $this->validate([
            'name' => 'required|max:24',
            'about' => 'required|max:140'
        ]);

        auth()->user()->update($profileData);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
