<?php

namespace App\View\Components;

use Illuminate\View\Component;

class announcementForm extends Component
{

    public $classes;

    public $announcement;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($classes, $announcement = null)
    {
        $this->classes = $classes;
        $this->announcement = $announcement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.announcement-form');
    }
}
