<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $newAvatar;

    protected $rules = [
        'user.name' => 'required|max:24',
        'user.about' => 'required|max:140',
        'user.birthday' => 'sometimes',
        'newAvatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $profileData = $this->validate();

        $this->user->save();

        if ($this->newAvatar) {
            $filename = $this->newAvatar->store('/', 'avatars');
            $this->user->update(['avatar' => $filename]);
        }

        $this->emitSelf('notify-saved');
    }

    public function updatedNewAvatar()
    {
        $this->validate([
            'newAvatar' => 'image|max:2048'
        ]);
    }

    public function render()
    {
        return view('livewire.profile')->layout('layouts.app');
    }
}
