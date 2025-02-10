<?php

namespace App\View\Components\Forms\Buttons;

use Closure;
use Illuminate\Contracts\View\View;

class Additonal extends AbstractButton
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.buttons.additonal');
    }
}
