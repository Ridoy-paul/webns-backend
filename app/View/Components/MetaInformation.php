<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaInformation extends Component
{
    public $metainfo;
    /**
     * Create a new component instance.
     */
    public function __construct($metainfo = [])
    {
        $this->metainfo = $metainfo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meta-information');
    }
}
