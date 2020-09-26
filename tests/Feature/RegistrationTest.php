<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_register()
    {
        Livewire::test('auth.register')
            ->set('email', 'bob@test.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('bob@test.com')->exists());

        $this->assertEquals('bob@test.com', auth()->user()->email);
    }

    /** @test */
    function email_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('email', 'pumpkins')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_is_unique()
    {
        User::create([
            'email' => 'frank@mail.com',
            'password' => Hash::make('password')
        ]);

        Livewire::test('auth.register')
            ->set('email', 'frank@mail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', 'frank@mail.com')
            ->set('password', '')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

        /** @test */
        function password_is_min_six_chars()
        {
            Livewire::test('auth.register')
                ->set('email', 'frank@mail.com')
                ->set('password', 'secre')
                ->set('passwordConfirmation', 'secret')
                ->call('register')
                ->assertHasErrors(['password' => 'min']);
        }

                /** @test */
                function passwords_matches()
                {
                    Livewire::test('auth.register')
                        ->set('email', 'frank@mail.com')
                        ->set('password', 'secret')
                        ->set('passwordConfirmation', 'not-secret')
                        ->call('register')
                        ->assertHasErrors(['password' => 'same']);
                }
}
