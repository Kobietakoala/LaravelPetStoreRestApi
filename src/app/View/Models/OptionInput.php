<?php

namespace App\View\Models;

class OptionInput
{

    public function __construct(public string $name, public string $value) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value
        ];
    }
}
