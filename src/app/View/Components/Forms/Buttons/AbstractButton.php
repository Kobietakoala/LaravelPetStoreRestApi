<?php

namespace App\View\Components\Forms\Buttons;

use Illuminate\View\Component;
use App\Enum\ButtonTypeEnum;

abstract class AbstractButton extends Component
{
    public function __construct(
        public int $textType = ButtonTypeEnum::SAVE->value
    )
    {
        //
    }

}