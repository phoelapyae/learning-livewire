<div>
    @foreach ($contacts as $contact)
    <div>
        @livewire('say-hi',['contact' => $contact], key($contact->id))
        <button wire:click="removeContact('{{ $contact->id }}')">Remove</button>
    </div>
    @endforeach

    <hr>
    <button wire:click="$emit('refreshChildren')">refresh</button>
    {{ now() }}
</div>