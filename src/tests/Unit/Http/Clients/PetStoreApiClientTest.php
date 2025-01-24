<?php

namespace Tests\Unit\Http\Clients;

use App\DTO\PetStoreDTO;
use App\Exceptions\PetStoreApiClientException;
use App\Http\Clients\PetStoreApiClient;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use Tests\TestCase;

class PetStoreApiClientTest extends TestCase
{
    private PetStoreApiClient $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = app(PetStoreApiClient::class);
    }

    public function testCanPostPet(): PetStoreDTO
    {
        $expectedDto = new PetStoreDTO(
            fake()->name(),
            [
                fake()->imageUrl()
            ]
        );

        $responseDto = $this->api->postPet($expectedDto);

        $this->assertSame($expectedDto->name, $responseDto->name);
        $this->assertEqualsCanonicalizing($expectedDto->photoUrls, $responseDto->photoUrls);

        return $responseDto;
    }

    #[Depends('testCanPostPet')]
    public function testCanGetPet(PetStoreDTO $expectedDto): PetStoreDTO
    {
        $responseDto = $this->api->getPet($expectedDto->id);

        $this->assertSame($expectedDto->name, $responseDto->name);
        $this->assertEqualsCanonicalizing($expectedDto->photoUrls, $responseDto->photoUrls);

        return $expectedDto;
    }

    #[Depends('testCanGetPet')]
    public function testCanPutPet(PetStoreDTO $expectedDto): PetStoreDTO
    {
        $expectedDto->name = fake()->name();

        $responseDto = $this->api->putPet($expectedDto);

        $this->assertSame($expectedDto->name, $responseDto->name);
        $this->assertEqualsCanonicalizing($expectedDto->photoUrls, $responseDto->photoUrls);

        return $expectedDto;
    }

    #[Depends('testCanPutPet')]
    #[DoesNotPerformAssertions]
    public function testCanDeletePet(PetStoreDTO $expectedDto): void
    {
        $this->api->deletePet($expectedDto->id);
    }

    public function testPostPetThrowExceptionOnFail(): void
    {
        Http::fake([
            '*' => Http::response([
                'type'       => 'unknown',
                'message'    => 'Invalid input'
            ], Response::HTTP_METHOD_NOT_ALLOWED),
        ]);

        $expectedDto = new PetStoreDTO(
            fake()->name(),
            []
        );

        $this->expectException(PetStoreApiClientException::class);

        $this->api->postPet($expectedDto);
    }

    public function testPutPetThrowExceptionOnFail(): void
    {
        Http::fake([
            '*' => Http::response([
                'type'       => 'unknown',
                'message'    => 'Invalid input'
            ], Response::HTTP_METHOD_NOT_ALLOWED),
        ]);

        $expectedDto = new PetStoreDTO(
            fake()->name(),
            []
        );

        $this->expectException(PetStoreApiClientException::class);

        $this->api->putPet($expectedDto);
    }

    public function testGetPetThrowExceptionOnFail(): void
    {
        $id = fake()->randomNumber();
        Http::fake([
            '*' => Http::response([
                'type'       => 'unknown',
                'message'    => 'Invalid input'
            ], Response::HTTP_METHOD_NOT_ALLOWED),
        ]);

        $this->expectException(PetStoreApiClientException::class);

        $this->api->getpet($id);
    }

    public function testDeletePetThrowExceptionOnFail(): void
    {
        $id = fake()->randomNumber();
        Http::fake([
            '*' => Http::response([
                'type'       => 'unknown',
                'message'    => 'Invalid input'
            ], Response::HTTP_METHOD_NOT_ALLOWED),
        ]);

        $this->expectException(PetStoreApiClientException::class);

        $this->api->deletePet($id);
    }
}
