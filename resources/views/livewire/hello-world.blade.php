<div>
    <input type="text" wire:model.debounce.1000ms="name">
    <input type="checkbox" wire:model="loud">
    <select wire:model="greeting" multiple>
        <option>Hello</option>
        <option>Goodbye</option>
        <option>Nice to meet you</option>
    </select>

    {{ implode(', ', $greeting) }} {{ $name }} @if($loud) ! @endif
</div>