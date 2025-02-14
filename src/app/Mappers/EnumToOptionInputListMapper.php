<?php

declare(strict_types=1);

namespace App\Mappers;

use App\Enum\ExampleCategoriesDataEnum;
use App\Enum\ExampleTagsDataEnum;
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
        foreach (StatusEnum::cases() as $index => $case) {
            $options[] =  new OptionInput($index, $case->name, $case->value);
        }

        return $options;
    }

    /**
     * Summary of fromExampleCategoriesDataEnum
     * @return OptionInput[]
     */
    public static function fromExampleCategoriesDataEnum(): array
    {
        $options = [];
        foreach (ExampleCategoriesDataEnum::cases() as $index => $case) {
            $options[] =  new OptionInput($index, $case->name, $case->value);
        }

        return $options;
    }

    /**
     * Summary of fromExampleTagsDataEnum
     * @return OptionInput[]
     */
    public static function fromExampleTagsDataEnum(): array
    {
        $options = [];
        foreach (ExampleTagsDataEnum::cases() as $index => $case) {
            $options[] =  new OptionInput($index, $case->name, $case->value);
        }

        return $options;
    }
}
