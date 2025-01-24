<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\DTO\PetStoreDTO;
use App\Enum\StatusEnum;
use App\Exceptions\PetStoreApiClientException;
use App\Exceptions\PetStoreServiceException;
use App\Http\Clients\PetStoreApiClient;
use App\Http\Clients\PetStoreApiClientInterface;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Tag;
use App\Services\PetStoreService;
use App\Services\PetStoreServiceInterface;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Mockery\Mock;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use Tests\TestCase;

class PetStoreServiceTest extends TestCase
{
    private PetStoreServiceInterface $service;
    private PetStoreApiClientInterface&MockInterface $api;

    protected function setUp(): void
    {
        parent::setUp();
        $this->api =  $this->mock(PetStoreApiClient::class);
        $this->service = app(PetStoreService::class);
    }

    public function testCanCreatePet(): void
    {
        $category = Category::factory()->make();
        $tag = Tag::factory()->make();
        $data = [
            'name' => fake()->name(),
            'photoUrls' => [fake()->url()],
            'id' => null,
            'status' => StatusEnum::SOLD->value(),
            'tags' => [
                [
                    'id' => $tag->id,
                    'name' => $tag->name
                ]
            ],
            'category' => [
                'id' => $category->id,
                'name' => $category->name
            ],
        ];

        $this->api
            ->shouldReceive('postPet')
            ->once()
            ->andReturn(new PetStoreDTO(...$data));

        $pet = $this->service->new($data);

        $this->assertSame($data['id'], $pet->id);
        $this->assertSame($data['name'], $pet->name);
        $this->assertSame($data['photoUrls'], $pet->photoUrls);
        $this->assertSame(StatusEnum::tryFrom($data['status']), $pet->status);
        $this->assertEqualsCanonicalizing($category, $pet->category);
        $this->assertEqualsCanonicalizing([$tag], $pet->tags);
    }

    public function testCanUpdatePet(): void
    {
        $category = Category::factory()->make();
        $tag = Tag::factory()->make();
        $id = fake()->randomNumber();
        $data = [
            'name' => fake()->name(),
            'photoUrls' => [fake()->url()],
            'id' => $id,
            'status' => StatusEnum::SOLD->value(),
            'tags' => [
                [
                    'id' => $tag->id,
                    'name' => $tag->name
                ]
            ],
            'category' => [
                'id' => $category->id,
                'name' => $category->name
            ],
        ];

        $this->api
            ->shouldReceive('putPet')
            ->once()
            ->andReturn(new PetStoreDTO(...$data));

        $pet = $this->service->update($id, $data);

        $this->assertSame($data['id'], $pet->id);
        $this->assertSame($data['name'], $pet->name);
        $this->assertSame($data['photoUrls'], $pet->photoUrls);
        $this->assertSame(StatusEnum::tryFrom($data['status']), $pet->status);
        $this->assertEqualsCanonicalizing($category, $pet->category);
        $this->assertEqualsCanonicalizing([$tag], $pet->tags);
    }

    public function testCanFindPet(): void
    {
        $id = fake()->randomNumber();
        $name = fake()->name();
        $photoUrls = [fake()->url()];

        $this->api
            ->shouldReceive('getPet')
            ->once()
            ->with($id)
            ->andReturn(new PetStoreDTO(
                id: $id,
                name: $name,
                photoUrls: $photoUrls
            ));

        $pet = $this->service->find($id);

        $this->assertInstanceOf(Pet::class, $pet);
        $this->assertSame($id, $pet->id);
        $this->assertSame($name, $pet->name);
        $this->assertSame($photoUrls, $pet->photoUrls);
    }

    public function testCanRemove(): void
    {
        $id = fake()->randomNumber();

        $this->api
            ->shouldReceive('deletePet')
            ->once()
            ->with($id)
            ->andReturn(true);

        $this->service->remove($id);
    }

    public function testNewPetThrowsException(): void
    {
        $category = Category::factory()->make();
        $tag = Tag::factory()->make();
        $data = [
            'name' => fake()->name(),
            'photoUrls' => [fake()->url()],
            'id' => null,
            'status' => StatusEnum::SOLD->value(),
            'tags' => [
                [
                    'id' => $tag->id,
                    'name' => $tag->name
                ]
            ],
            'category' => [
                'id' => $category->id,
                'name' => $category->name
            ],
        ];

        $this->api
            ->shouldReceive('postPet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_METHOD_NOT_ALLOWED);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_INPUT);
        $this->expectExceptionCode(Response::HTTP_METHOD_NOT_ALLOWED);

        $this->service->new($data);
    }

    public function testUpdatePetThrowsExceptions(): void
    {
        $category = Category::factory()->make();
        $tag = Tag::factory()->make();
        $data = [
            'name' => fake()->name(),
            'photoUrls' => [fake()->url()],
            'id' => null,
            'status' => StatusEnum::SOLD->value(),
            'tags' => [
                [
                    'id' => $tag->id,
                    'name' => $tag->name
                ]
            ],
            'category' => [
                'id' => $category->id,
                'name' => $category->name
            ],
        ];

        /** Response::HTTP_METHOD_NOT_ALLOWED */
        $this->api
            ->shouldReceive('postPet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_METHOD_NOT_ALLOWED);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_INPUT);
        $this->expectExceptionCode(Response::HTTP_METHOD_NOT_ALLOWED);

        $this->service->new($data);

        /** Response::HTTP_BAD_REQUEST */
        $this->api
            ->shouldReceive('postPet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_BAD_REQUEST);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::PET_NOT_FOUND);
        $this->expectExceptionCode(Response::HTTP_BAD_REQUEST);

        $this->service->new($data);

        /** Response::HTTP_NOT_FOUND */
        $this->api
            ->shouldReceive('postPet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_NOT_FOUND);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_ID);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);

        $this->service->new($data);
    }

    public function testFindPetThrowsExceptions(): void
    {
        /** Response::HTTP_BAD_REQUEST */
        $this->api
            ->shouldReceive('getPet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_BAD_REQUEST);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_ID);
        $this->expectExceptionCode(Response::HTTP_BAD_REQUEST);

        $this->service->find(fake()->randomNumber());

        /** Response::HTTP_NOT_FOUND */
        $this->api
            ->shouldReceive('getPet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_NOT_FOUND);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_ID);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);

        $this->service->find(fake()->randomNumber());
    }

    public function testRemovePetThrowsExceptions(): void
    {
        /** Response::HTTP_BAD_REQUEST */
        $this->api
            ->shouldReceive('deletePet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_BAD_REQUEST);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_ID);
        $this->expectExceptionCode(Response::HTTP_BAD_REQUEST);

        $this->service->remove(fake()->randomNumber());

        /** Response::HTTP_NOT_FOUND */
        $this->api
            ->shouldReceive('deletePet')
            ->once()
            ->andThrow(PetStoreApiClientException::class, 'msg', Response::HTTP_NOT_FOUND);

        $this->expectException(PetStoreServiceException::class);
        $this->expectExceptionMessage(PetStoreServiceException::INVALID_ID);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);

        $this->service->remove(fake()->randomNumber());
    }
}
