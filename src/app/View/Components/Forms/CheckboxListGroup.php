<?php

namespace App\View\Components\Forms;

use App\Mappers\EnumToOptionInputListMapper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxListGroup extends Component
{
    public array $optionsArray = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id, 
        public string $label,
        public string $name,
        public string $optionListName,
        public ?string $description,
    ) {
        $this->chosseOptionsArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.checkbox-list-group');
    }

    private function chosseOptionsArray(): void
    {
        $this->optionsArray = match ($this->optionListName) {
            'petTags' => EnumToOptionInputListMapper::fromExampleTagsDataEnum(),
            default => []
        };
    }
}
