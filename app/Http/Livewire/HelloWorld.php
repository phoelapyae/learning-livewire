<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Contact;

class HelloWorld extends Component
{
    public $contacts;

    protected $listeners = ['foo' => '$refresh'];

    public function mount()
    {
        $this->contacts = Contact::all();
    }

    public function removeContact($id)
    {
        Contact::find($id)->delete();
        $this->contacts = Contact::all();
    }

    public function render()
    {
        return view('livewire.hello-world');
    }
}
