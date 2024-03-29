<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class TimeInput extends Component
{
    public $label;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $name, $value = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.time-input');
    }
}
