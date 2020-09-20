<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{

    public $logo;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($logo, $title)
    {
        $this->logo = $logo;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu');
    }
}
