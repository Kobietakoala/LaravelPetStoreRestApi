<?php
declare(strict_types=1);

namespace App\Http\Clients;

use App\DTO\PetStoreDTO;
use Illuminate\Support\Facades\Http;

/**
 * @package App\Http\Clients
 */
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

    public function getPet(int $id): PetStoreDTO
    {
       $response = Http::get("{$this->baseUrl}/pet/$id");
        
       if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return PetStoreDTO::fromApiResponse($response->json());
    }

    public function postPet(PetStoreDTO $dto): PetStoreDTO
    {
        $response = HTTP::post("{$this->baseUrl}/pet/$dto->id", $dto->toApiPayload());

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return PetStoreDTO::fromApiResponse($response->json());
    }

    public function deletePet(int $id): bool
    {
        $response = HTTP::delete("{$this->baseUrl}/pet/$id");

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return true;
    }
}
