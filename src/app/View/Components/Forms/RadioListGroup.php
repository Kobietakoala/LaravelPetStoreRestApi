<?php

namespace App\View\Components\Forms;

use App\Mappers\EnumToOptionInputListMapper;
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
        return view('components.forms.radio-list-group');
    }

    private function chosseOptionsArray(): void
    {
        /**
         * @todo wynieść gdzieś ten match
         */
        $this->optionsArray = match ($this->optionListName) {
            'petCategories' => [
                ['name' => 'Doggo', 'value' => 'Doggo'],
                ['name' => 'City Cat', 'value'  => 'City Cat'],
                ['name' => 'Hamster Boss', 'value'  => 'Hamster Boss'],
                ['name' => 'Grredy Housefly', 'value'  => 'Grredy Housefly'],
            ],
            'petStatuses' => EnumToOptionInputListMapper::fromStatusEnum(),
            default => []
        };
    }
}
