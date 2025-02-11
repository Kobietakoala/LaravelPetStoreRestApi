<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\PetStoreDTO;
use App\Exceptions\PetStoreApiClientException;
use App\Exceptions\PetStoreServiceException;
use App\Http\Clients\PetStoreApiClientInterface;
use App\Mappers\PetStoreMapper;
use App\Models\Pet;
use Illuminate\Http\Response;
use InvalidArgumentException;

class PetStoreService implements PetStoreServiceInterface
{
    public function __construct(
        private PetStoreApiClientInterface $petStoreApiClient
    ) {}

    /**
     * @param array $data
     * @return Pet
     * 
     * @throws PetStoreServiceException
     */
    public function new(array $data): Pet
    {
        $petStoreDto = new PetStoreDTO(...$data);
        
        try {
            $pet = $this->petStoreApiClient->postPet($petStoreDto);
        } catch (PetStoreApiClientException $apiException) {

            if ($apiException->getCode() === Response::HTTP_METHOD_NOT_ALLOWED) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::INVALID_INPUT,
                    $apiException->getCode(),
                    $apiException
                );
            }

            throw new PetStoreServiceException($apiException->getMessage(), $apiException->getCode(), $apiException);
        }

        return PetStoreMapper::toPetModel($pet);
    }

    /**
     * @param integer $id
     * @param array $data
     * @return Pet
     * 
     * @throws PetStoreServiceException
     */
    public function update(int $id, array $data): Pet
    {
        $petStoreDto = new PetStoreDTO(...array_merge($data, ['id' => $id]));

        try {
            $pet = $this->petStoreApiClient->putPet($petStoreDto);
        } catch (PetStoreApiClientException $apiException) {

            if ($apiException->getCode() === Response::HTTP_BAD_REQUEST) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::INVALID_ID,
                    $apiException->getCode(),
                    $apiException
                );
            } else if ($apiException->getCode() === Response::HTTP_NOT_FOUND) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::PET_NOT_FOUND,
                    $apiException->getCode(),
                    $apiException
                );
            } else if ($apiException->getCode() === Response::HTTP_METHOD_NOT_ALLOWED) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::INVALID_INPUT,
                    $apiException->getCode(),
                    $apiException
                );
            }

            throw new PetStoreServiceException($apiException->getMessage(), $apiException->getCode(), $apiException);
        }

        return PetStoreMapper::toPetModel($pet);
    }

    /**
     * @param integer $id
     * @return Pet
     * 
     * @throws PetStoreServiceException
     */
    public function find(int $id): Pet
    {
        try {
            $pet = $this->petStoreApiClient->getPet($id);
        } catch (PetStoreApiClientException $apiException) {

            if ($apiException->getCode() === Response::HTTP_BAD_REQUEST) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::INVALID_ID,
                    $apiException->getCode(),
                    $apiException
                );
            } else if ($apiException->getCode() === Response::HTTP_NOT_FOUND) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::PET_NOT_FOUND,
                    $apiException->getCode(),
                    $apiException
                );
            }

            throw new PetStoreServiceException($apiException->getMessage(), $apiException->getCode(), $apiException);
        }

        return PetStoreMapper::toPetModel($pet);
    }

    /**
     *
     *
     * @param integer $id
     * @return void
     * 
     * @throws Exception
     */
    public function remove(int $id): void
    {
        try {
            $this->petStoreApiClient->deletePet($id);
        } catch (PetStoreApiClientException $apiException) {
            if ($apiException->getCode() === Response::HTTP_BAD_REQUEST) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::INVALID_ID,
                    $apiException->getCode(),
                    $apiException
                );
            } else if ($apiException->getCode() === Response::HTTP_NOT_FOUND) {
                throw new PetStoreServiceException(
                    PetStoreServiceException::PET_NOT_FOUND,
                    $apiException->getCode(),
                    $apiException
                );
            }

            throw new PetStoreServiceException($apiException->getMessage(), $apiException->getCode(), $apiException);
        }
    }
}
