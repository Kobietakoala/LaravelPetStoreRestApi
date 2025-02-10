<?php

namespace App\View\Components\Forms;

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
        /**
         * @todo wynieść gdzieś ten match
         */
        $this->optionsArray = match ($this->optionListName) {
            'petTags' => [
                ['name' => 'Super Cute', 'value' => 0],
                ['name' => 'Clear Evil', 'value'  => 1],
                ['name' => 'Week Boss', 'value'  => 2],
                ['name' => 'Lucky Monster', 'value'  => 3],
            ],
            default => []
        };
    }
}
