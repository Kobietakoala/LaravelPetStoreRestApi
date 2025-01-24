<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PetStoreRequest;
use App\Services\PetStoreServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PetStoreController
{

    public function __construct(private PetStoreServiceInterface $service) {}

    public function show(int $id): JsonResponse
    {
        $pet = $this->service->find($id);

        return new JsonResponse($pet->toArray(), Response::HTTP_OK);
    }

    public function store(PetStoreRequest $request): JsonResponse
    {
        $pet = $this->service->new($request->all());

        return new JsonResponse($pet->toArray(), Response::HTTP_CREATED);
    }

    public function update(int $id, PetStoreRequest $request): JsonResponse
    {
        $pet = $this->service->update($id, $request->all());

        return new JsonResponse($pet->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->remove($id);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
