<?php

declare(strict_types=1);

namespace Tests\Unit\Mappers;

use App\Enum\StatusEnum;
use App\Mappers\EnumToOptionInputListMapper;
use Tests\TestCase;

class EnumToOptionInputListMapperTest extends TestCase
{
    public function testCanMapFromStatusEnum(): void
    {
        $statuses = StatusEnum::cases();
        $options = EnumToOptionInputListMapper::fromStatusEnum();

        $this->assertEquals(count($statuses), count($options));

        foreach ($options as $input) {
            $status = StatusEnum::tryFrom($input->value);
           
            $this->assertEquals($status->name, $input->name);
            $this->assertEquals($status->value, $input->value);

            // usuniecie sprawdzonych elementów
            $index = array_search($status, $statuses);
            unset( $statuses[$index] );
        }

        $this->assertEmpty($statuses);
    }
}
