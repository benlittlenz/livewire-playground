<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    public $active = true;

    public function render()
    {
        return view('livewire.datatable', [
            'users' => User::where('active', $this->active)
                ->paginate(10)
        ]);
    }
}
