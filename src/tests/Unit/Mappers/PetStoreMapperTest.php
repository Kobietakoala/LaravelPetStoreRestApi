<?php

declare(strict_types=1);

namespace Tests\Unit\Mappers;

use App\DTO\PetStoreDTO;
use App\Enum\StatusEnum;
use App\Mappers\PetStoreMapper;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Tag;
use Tests\TestCase;

class PetStoreMapperTest extends TestCase
{
    public function testCanMapPetToPetStroreDto(): void
    {
        $pet = Pet::factory()
            ->withId()
            ->withStatus()
            ->withCategory()
            ->withTags()
            ->make();

        $dto = PetStoreMapper::fromPetModel($pet);

        $this->assertSame($pet->id, $dto->id);
        $this->assertSame($pet->name, $dto->name);
        $this->assertSame($pet->photoUrls, $dto->photoUrls);
        $this->assertSame($pet->status->value(), $dto->status);
        $this->assertSame($pet->category->toArray(), $dto->category);
        $this->assertEqualsCanonicalizing($pet->tags->toArray(), $dto->tags);
    }

    public function testCanMapPetStoreDtoToPetModel(): void
    {
        $dtoCategory = Category::factory()->make();
        $dtoTag = Tag::factory()->make();

        $dto = new PetStoreDTO(
            name: fake()->name(),
            photoUrls: [
                fake()->imageUrl()
            ],
            id: fake()->randomNumber(),
            status: 'available',
            tags: [
                [
                    'id' => $dtoTag->id,
                    'name' => $dtoTag->name
                ]
            ],
            category: [
                'id' => $dtoCategory->id,
                'name' => $dtoCategory->name
            ]
        );

        $pet = PetStoreMapper::toPetModel($dto);

        $this->assertSame($dto->id, $pet->id);
        $this->assertSame($dto->name, $pet->name);
        $this->assertSame($dto->photoUrls, $pet->photoUrls);
        $this->assertSame(StatusEnum::tryFrom($dto->status), $pet->status);
        $this->assertEqualsCanonicalizing($dtoCategory, $pet->category);
        $this->assertEqualsCanonicalizing([$dtoTag], $pet->tags);
    }
}
