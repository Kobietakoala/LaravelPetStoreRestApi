<?php

namespace App\View\Models;

class OptionInput
{

    public function __construct(public int $id, public string $name, public string $value) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value
        ];
    }
}
