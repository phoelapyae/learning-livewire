<div>
    <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>

    <form wire:submit.prevent="save">
        <div class="mt-6 sm:mt-5 space-y-5">

            <x-input.group label="User Name" for="name" :error="$errors->first('name')">
                <x-input.text wire:model="name" id="name" leading-add-on="surge.com/" />
            </x-input.group>

            <x-input.group label="Birthday" for="birthday" :error="$errors->first('birthday')">
                <x-input.date wire:model.lazy="birthday" id="birthday" placeholder="MM/DD/YYYY" autocomplete="off" />
            </x-input.group>

            <x-input.group label="About" for="about" :error="$errors->first('about')" help-text="Write a few sentences about yourself.">
                <x-input.rich-text wire:model.lazy="about" :initial-value="$about" id="about" />
            </x-input.group>

            <x-input.group label="Profile" for="photo" :error="$errors->first('newAvatar')">

                <!-- <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    @if ($newAvatar)
                    <img class="h-12 w-12" src="{{ $newAvatar->temporaryUrl() }}" alt="Profile Photo">
                    @else
                    <img class="h-12 w-12" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                    @endif
                </span> -->

                @foreach($files as $file)
                <img src="{{ $file->temporaryUrl() }}">
                @endforeach

                <x-input.filepond wire:model="files" />
            </x-input.group>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="space-x-3 flex justify-end items-center">


                <span x-data="{open: false}" x-init="
                        @this.on('notify-saved', () => {
                            open = true;
                            setTimeout(() => {open = false}, 2500);
                        })
                        " x-ref="this" x-show.transition.duration.1000ms="open" class="text-green-500">Saved!</span>


                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </button>
                </span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>