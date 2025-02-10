<?php

namespace App\View\Components\Forms\Buttons;

use Closure;
use Illuminate\Contracts\View\View;

class Basic extends AbstractButton
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|int
    {
        return view('components.forms.buttons.basic');
    }
}
