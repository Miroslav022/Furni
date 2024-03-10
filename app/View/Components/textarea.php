<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public $idText;
    public $labelText;
    public $nameText;
    public function __construct($nameText, $labelText, $idText)
    {
        //
        $this->nameText = $nameText;
        $this->idText = $idText;
        $this->labelText = $labelText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
