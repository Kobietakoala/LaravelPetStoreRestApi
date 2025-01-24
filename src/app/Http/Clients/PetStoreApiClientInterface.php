<?php

declare(strict_types=1);

namespace App\Http\Clients;

use App\DTO\PetStoreDTO;

/**
 * @package App\Clients
 */
interface PetStoreApiClientInterface
{
    public function getPet(int $id): PetStoreDTO;
    public function postPet(PetStoreDTO $dto): PetStoreDTO;
    public function putPet(PetStoreDTO $dto): PetStoreDTO;
    public function deletePet(int $id): void;
}
