<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Datatable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatatableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function main_page_contains_datatable_component()
    {
        $this->get('/')
            ->assertSeeLivewire('datatable');

    }

    /** @test */
    public function datatables_searches_name_correctly()
    {
        $userA = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);

        $userB = User::create([
            'name' => 'Another',
            'email' => 'another@another.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);

        Livewire::test(DataTable::class)
            ->assertSee($userA->name)
            ->assertSee($userB->name)
            ->set('search', 'user')
            ->assertSee($userA->name)
            ->assertDontSee($userB->name);
    }
}
