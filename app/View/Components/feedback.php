<?php

namespace App\View\Components;

use Illuminate\View\Component;

class feedback extends Component
{
    public $classes;

    public function __construct($classes)
    {
        $this->classes = $classes;
    }

    public function render()
    {
        return view('components.feedback');
    }
}
