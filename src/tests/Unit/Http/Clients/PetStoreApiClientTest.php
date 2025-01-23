<?php

namespace Tests\Unit\Http\Clients;

use App\DTO\PetStoreDTO;
use App\Http\Clients\PetStoreApiClient;
use PHPUnit\Framework\Attributes\Depends;
use Tests\TestCase;

/**
 * @package App\Unit\Test
 */
class PetStoreApiClientTest extends TestCase
{
    private PetStoreApiClient $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new PetStoreApiClient();
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
    public function testCanUpdatePetByPostPet(PetStoreDTO $expectedDto): PetStoreDTO
    {        
        $expectedDto->name = fake()->name();

        $responseDto = $this->api->postPet($expectedDto);

        $this->assertSame($expectedDto->name, $responseDto->name);
        $this->assertEqualsCanonicalizing($expectedDto->photoUrls, $responseDto->photoUrls);
        
        return $expectedDto;
    }

    #[Depends('testCanUpdatePetByPostPet')]
    public function testCanDeletePet(PetStoreDTO $expectedDto): void
    {   
        $this->assertTrue($this->api->deletePet($expectedDto->id));
    }
}
