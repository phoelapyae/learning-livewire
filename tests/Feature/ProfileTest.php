<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
    public function can_upload_avatar()
    {
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.png');

        Storage::fake('avatars');

        Livewire::actingAs($user)
            ->test('profile')
            ->set('newAvatar', $file)
            ->call('save')
            ->assertHasErrors(['newAvatar' => 'mimes']);

        $user->refresh();

        // $this->assertNull($user->avatar);
        // Storage::disk('avatars')->assertExists('avatar.png');
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

    /** @test */
    public function profile_info_is_prepopulated()
    {
        $user = User::factory()->create([
            'name' => 'foo',
            'about' => 'bar'
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->assertSet('name', 'foo')
            ->assertSet('about', 'bar');
    }

    /** @test */
    public function message_shown_on_save()
    {
        $user = User::factory()->create([
            'name' => 'foo',
            'about' => 'bar'
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->call('save')
            ->assertEmitted('notify-saved');
    }
}
