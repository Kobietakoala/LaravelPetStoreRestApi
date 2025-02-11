<?php
declare(strict_types=1);

namespace App\Mappers;

use App\Enum\StatusEnum;
use App\View\Models\OptionInput;


final class EnumToOptionInputListMapper
{
    /**
     * Summary of fromStatusEnum
     * @return OptionInput[]
     */
    public static function fromStatusEnum(): array
    {
        $options = [];
        foreach(StatusEnum::cases() as $case) {
            $options[] =  new OptionInput($case->name, $case->value);
        }

        return $options;
    }
}