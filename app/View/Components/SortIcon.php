<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SortIcon extends Component
{
    public $field;
    public $sortField;
    public $asc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $sortField, $asc)
    {
        $this->field = $field;
        $this->sortField = $sortField;
        $this->asc = $asc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sort-icon');
    }
}
