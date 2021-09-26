<?php

namespace Tests\Feature;

use App\Http\Livewire\Auth\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\LivewireManager;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_register()
    {
        User::create([
            'name' => 'Calab',
            'email' => 'calab@gmail.com',
            'password' => Hash::make('password')
        ]);

        Livewire::test('auth.register')
            ->set('name', 'Calab')
            ->set('email', 'calab@gmail.com')
            ->set('password', 'password')
            ->call('register');

        // $this->assertTrue(!User::whereEmail('caleb@gmail.com')->exists());
    }

    /** @test */
    function email_has_already_been_taken()
    {
        User::create([
            'name' => 'Calab',
            'email' => 'calab@gmail.com',
            'password' => Hash::make('password')
        ]);

        $component = app(LivewireManager::class)->test(Register::class);

        $component
            ->set('email', 'calab@gmail.com')
            ->assertHasNoErrors()
            ->set('email', 'calab@gmail.com')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function email_is_required()
    {

        Livewire::test('auth.register')
            ->set('email', 'calab')
            ->call('register');
    }
}
