<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioListGroup extends Component
{
    public array $optionsArray = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
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
        return view('components.forms.radio-list-group')
            ->with('options', $this->optionsArray);
    }

    private function chosseOptionsArray(): void
    {
        /**
         * @todo wynieść gdzieś ten match
         */
        $this->optionsArray = match ($this->optionListName) {
            'petCategories' => [
                ['name' => 'Doggo', 'value' => 0],
                ['name' => 'City Cat', 'value'  => 1],
                ['name' => 'Hamster Bos', 'value'  => 2],
            ],
            default => []
        };
    }
}
