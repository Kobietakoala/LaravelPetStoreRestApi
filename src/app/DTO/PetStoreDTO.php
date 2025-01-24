<?php
declare(strict_types=1);

namespace App\DTO;

/**
 * @package App\DTO
 */
class PetStoreDTO
{
	public function __construct(
        public string $name,
        public array $photoUrls,
        public ?int $id = null,
        public ?string $status = null,
        public ?array $tags = null,
        public ?array $category = null,
    ) {} 

    /**
     * Map PetStoreApiClient response to PetStoreDto
     *
     * @param array $data
     * @return self
     */
    public static function fromApiResponse(array $data): self
    {
        return new self(
            $data['name'],
            $data['photoUrls'],
            $data['id'] ?? null,
            $data['status'] ?? null,
            $data['tags'] ?? null,
            $data['category'] ?? null,
        );
    }

    /**
     * Map PetStoreDto to PetStoreApiClient payload
     *
     * @return array
     */
    public function toApiPayload(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photoUrls' => $this->photoUrls,
            'status' =>  $this->status,
            'tags' => $this->tags,
            'category' => $this->category,
        ];
    }
}