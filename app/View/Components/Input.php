<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public $idText;
    public $labelText;
    public $typeText;
    public function __construct($idText, $typeText, $labelText)
    {
        //
        $this->idText = $idText;
        $this->labelText = $labelText;
        $this->typeText = $typeText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
