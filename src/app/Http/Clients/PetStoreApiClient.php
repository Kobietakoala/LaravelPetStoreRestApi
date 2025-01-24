<?php

declare(strict_types=1);

namespace App\Http\Clients;

use App\DTO\PetStoreDTO;
use App\Exceptions\PetStoreApiClientException;
use Illuminate\Support\Facades\Http;

class PetStoreApiClient implements PetStoreApiClientInterface
{
    protected string $baseUrl;
    protected string $username;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl = config('services.petstore_api.base_url');
        $this->username = config('services.petstore_api.username');
        $this->password = config('services.petstore_api.password');
    }

    /**
     * @param integer $id
     * @return PetStoreDTO
     * 
     * @throws PetStoreApiClientException
     */
    public function getPet(int $id): PetStoreDTO
    {
        $response = Http::get("{$this->baseUrl}/pet/$id");

        if ($response->failed()) {
            $err = $response->json();
            throw new PetStoreApiClientException($err['message'], $response->status());
        }

        return PetStoreDTO::fromApiResponse($response->json());
    }

    /**
     * @param PetStoreDTO $dto
     * @return PetStoreDTO
     * 
     * @throws PetStoreApiClientException
     */
    public function postPet(PetStoreDTO $dto): PetStoreDTO
    {
        $response = HTTP::post("{$this->baseUrl}/pet", $dto->toApiPayload());

        if ($response->failed()) {
            $err = $response->json();
            throw new PetStoreApiClientException($err['message'], $response->status());
        }

        return PetStoreDTO::fromApiResponse($response->json());
    }

    /**
     * @param PetStoreDTO $dto
     * @return PetStoreDTO
     * 
     * @throws PetStoreApiClientException
     */
    public function putPet(PetStoreDTO $dto): PetStoreDTO
    {
        $response = HTTP::put("{$this->baseUrl}/pet", $dto->toApiPayload());

        if ($response->failed()) {
            $err = $response->json();
            throw new PetStoreApiClientException($err['message'], $response->status());
        }

        return PetStoreDTO::fromApiResponse($response->json());
    }

    /**
     * @param integer $id
     * @return void
     * 
     * @throws PetStoreApiClientException
     */
    public function deletePet(int $id): void
    {
        $response = HTTP::delete("{$this->baseUrl}/pet/$id");

        if ($response->failed()) {
            $err = $response->json();
            throw new PetStoreApiClientException($err['message'], $response->status());
        }
    }
}
