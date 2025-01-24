<?php

namespace Database\Factories;

use App\Enum\StatusEnum;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 * @package App\Factories
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => null,
            'name' => fake()->name(),
            'photoUrls' => [fake()->url()],
            'status' => null,
            'category' => null,
            'tags' => null
        ];
    }

    public function withId(): static
    {
        return $this->state(fn(array $attr) => [
            'id' => fake()->randomNumber()
        ]);
    }

    public function withStatus(): static
    {
        return $this->state(fn(array $attr) => [
            'status' => StatusEnum::SOLD
        ]);
    }

    public function withCategory(): static
    {
        return $this->afterMaking(function (Pet $pet) {
            $pet->category = Category::factory()->make();
        });
    }

    public function withTags(): static
    {
        return $this->afterMaking(function (Pet $pet) {
            $pet->tags = Tag::factory()->count(3)->make();
        });
    }
}
