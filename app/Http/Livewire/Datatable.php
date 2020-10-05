<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    public $active = true;
    public $search;
    public $sortField;
    public $asc = true;
    public $desc = false;
    protected $queryString = ['search', 'active', 'asc'];

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->asc = !$this->asc;
        } else {
            $this->asc = true;
        }
        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.datatable', [
            'users' => User::query()
                ->search($this->search)
                ->when($this->sortField, function($query) {
                    $query->orderBy($this->sortField, $this->asc ? 'asc' : 'desc');
                })
                ->paginate(10)
        ]);
    }
}
