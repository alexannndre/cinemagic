<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class TicketsTable extends Component
{
    public $tickets;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.tickets-table');
    }
}
