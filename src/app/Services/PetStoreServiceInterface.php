<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pet;

/**
 * @package App\Services
 */
interface PetStoreServiceInterface
{
    public function new(array $data): Pet;
    public function update(int $id, array $data): Pet;
    public function find(int $id): Pet;
    public function remove(int $id): void;
}
