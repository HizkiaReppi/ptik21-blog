<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PostLayout extends Component
{
    /**
     * Setting title pages
     */
    public function __construct(public $title = null)
    {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.post');
    }
}
