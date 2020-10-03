<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_see_profile_component()
    {
        $user = factory(User::class)->create();
        
        $this->get('/profile')
            ->assertSuccessful()
            ->assertSeeLivewire('profile');
    }
}
