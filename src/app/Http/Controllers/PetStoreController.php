<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\PetStoreServiceException;
use App\Http\Requests\PetStoreRequest;
use App\Services\PetStoreServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PetStoreController
{

    public function __construct(private PetStoreServiceInterface $service) {}

    public function show(int $id): JsonResponse
    {
        try {
            $pet = $this->service->find($id);
        } catch (PetStoreServiceException $e) {
            return $this->getResponseFromException($e);
        }


        return new JsonResponse($pet->toArray(), Response::HTTP_OK);
    }

    public function store(PetStoreRequest $request): JsonResponse
    {
        try {
            $pet = $this->service->new($request->all());
        } catch (PetStoreServiceException $e) {
            return $this->getResponseFromException($e);
        }


        return new JsonResponse($pet->toArray(), Response::HTTP_CREATED);
    }

    public function update(int $id, PetStoreRequest $request): JsonResponse
    {
        try {
            $pet = $this->service->update($id, $request->all());
        } catch (PetStoreServiceException $e) {
            return $this->getResponseFromException($e);
        }

        return new JsonResponse($pet->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->remove($id);
        } catch (PetStoreServiceException $e) {
            return $this->getResponseFromException($e);
        }

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    private function getResponseFromException(PetStoreServiceException $exception): JsonResponse
    {
        switch ($exception->getMessage()) {
            case PetStoreServiceException::INVALID_ID:
                return new JsonResponse(['message' => PetStoreServiceException::INVALID_ID], Response::HTTP_BAD_REQUEST);
            case PetStoreServiceException::INVALID_INPUT:
                return new JsonResponse(['message' => PetStoreServiceException::INVALID_INPUT], Response::HTTP_BAD_REQUEST);
            case PetStoreServiceException::PET_NOT_FOUND:
                return new JsonResponse(['message' => PetStoreServiceException::PET_NOT_FOUND], Response::HTTP_NOT_FOUND);
            default:
                return new JsonResponse(['message' => 'Something is wrong.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
