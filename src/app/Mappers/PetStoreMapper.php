<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\PetStoreDTO;
use App\Enum\StatusEnum;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Tag;

/**
 * @package App\Mappers
 */
class PetStoreMapper
{
    /**
     * @param Pet $pet
     * @return PetStoreDTO
     */
    public static function fromPetModel(Pet $pet): PetStoreDTO
    {
        return new PetStoreDTO(
            name: $pet->name,
            photoUrls: $pet->photoUrls,
            id: $pet->id,
            status: $pet->status->value(),
            tags: $pet->tags->toArray(),
            category: $pet->category->toArray()
        );
    }

    /**
     * @param PetStoreDTO $petstoreDTO
     * @return Pet
     */
    public static function toPetModel(PetStoreDTO $petstoreDTO): Pet
    {
        $tags = [];

        if (!empty($petstoreDTO->tags)) {
            foreach ($petstoreDTO->tags as $tag) {
                $tags[] = new Tag([
                    'id' => $tag['id'],
                    'name' => $tag['name']
                ]);
            }
        }

        return new Pet([
            'id' => $petstoreDTO->id,
            'name' => $petstoreDTO->name,
            'photoUrls' => $petstoreDTO->photoUrls,
            'status' => $petstoreDTO->status ? StatusEnum::tryFrom($petstoreDTO->status) : null,
            'tags' => $tags,
            'category' => $petstoreDTO->category ? new Category([
                'id' => $petstoreDTO->category['id'],
                'name' => $petstoreDTO->category['name']
            ]) : null,
        ]);
    }
}
