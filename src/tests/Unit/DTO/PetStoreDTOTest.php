<?php

namespace Tests\Feature\DTO;

use App\DTO\PetStoreDTO;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PetStoreDTOTest extends TestCase
{
    #[DataProvider('apiResponseDataProvider')]
    public function testCanCreatePetStoreDtoObjectFromApiResponse(array $apiResponse): void
    {
        $dto = PetStoreDTO::fromApiResponse($apiResponse);

        $this->assertSame($apiResponse['name'], $dto->name);
        $this->assertSame($apiResponse['photoUrls'], $dto->photoUrls);
        $this->assertSame($apiResponse['id'], $dto->id);
        $this->assertSame($apiResponse['status'], $dto->status);
        $this->assertSame($apiResponse['tags'], $dto->tags);
        $this->assertSame($apiResponse['category'], $dto->category);
    }

    #[DataProvider('apiPayloadDataProvider')]
    public function testCanCreatePetStoreDtoObjecttoApiPayload(PetStoreDTO $dto): void
    {
        $payload = $dto->toApiPayload();

        $this->assertSame($payload['name'], $dto->name);
        $this->assertSame($payload['photoUrls'], $dto->photoUrls);
        $this->assertSame($payload['id'], $dto->id);
        $this->assertSame($payload['status'], $dto->status);
        $this->assertSame($payload['tags'], $dto->tags);
        $this->assertSame($payload['category'], $dto->category);
    }

    public static function apiResponseDataProvider(): array
    {
        return [
            'simple' => [
                [
                    'name' => fake()->name(),
                    'photoUrls' => [
                        fake()->imageUrl()
                    ],
                    'id' => null,
                    'status' => null,
                    'tags' => null,
                    'category' => null
                ]
            ],
            'withAllData' => [
                [
                    'name' => fake()->name(),
                    'photoUrls' => [
                        fake()->imageUrl()
                    ],
                    'id' => fake()->randomNumber(),
                    'status' => 'available',
                    'tags' => [
                        [
                            'id' => fake()->randomNumber(),
                            'name' => fake()->name()
                        ]
                    ],
                    'category' => [
                        'id' => fake()->randomNumber(),
                        'name' => fake()->name()
                    ]
                ]
            ]
        ];
    }

    public static function apiPayloadDataProvider(): array
    {
        return [
            'simple' => [new PetStoreDTO(
                fake()->name(), // name
                [fake()->imageUrl()], // photoUrls
            )],
            'withAllData' => [new PetStoreDTO(
                fake()->name(), // name
                [fake()->imageUrl()], // photoUrls
                fake()->randomNumber(),  // id
                'available', // status
                [
                    [
                        'id' => fake()->randomNumber(),
                        'name' => fake()->name()
                    ]
                ], // tags
                [
                    'id' => fake()->randomNumber(),
                    'name' => fake()->name()
                ] // category
            )],
        ];
    }
}
