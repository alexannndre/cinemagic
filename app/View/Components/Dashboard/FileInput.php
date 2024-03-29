<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class FileInput extends Component
{
    public $name;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.file-input');
    }
}
