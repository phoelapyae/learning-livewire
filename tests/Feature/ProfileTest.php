<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_livewire_profile_component_on_profile_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/profile')
            ->assertSuccessful()
            ->assertSee('profile');
    }

    /** @test */
    public function can_update_profile()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('name', 'foo')
            ->set('about', 'bar')
            ->call('save');

        $user->refresh();

        $this->assertEquals('foo', $user->name);
    }

    /** @test */
    public function name_must_less_than_24_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('name', str_repeat('a', 25))
            ->set('about', 'bar')
            ->call('save')
            ->assertHasErrors(['name' => 'max']);
    }

    /** @test */
    public function about_must_less_than_140_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('name', 'foo')
            ->set('about', str_repeat('a', 141))
            ->call('save')
            ->assertHasErrors(['about' => 'max']);
    }
}