<div>
    <!-- <input type="text" wire:model="contact.name"> -->
    Ehello {{ $contact->name }} : {{ now() }}
    <button wire:click="emitFoo">refresh</button>
</div>