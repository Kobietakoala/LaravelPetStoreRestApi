<?php

namespace Tests\Unit;

use App\Enum\StatusEnum;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Tag;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @package App\Unit\Test
 */
class PetTest extends TestCase
{
 
    #[DataProvider('petDataProvider')]
    public function test_CanCreatePetModel(string $option, Pet $pet): void
    {
        $this->assertInstanceOf(Pet::class, $pet);
        $this->assertIsString($pet->name);
        $this->assertIsArray($pet->photoUrls);

        
        switch($option) {
            case 'withId':
                $this->assertIsInt($pet->id);
                break;
            case 'withStatus':
                $this->assertInstanceOf(StatusEnum::class, $pet->status);
                $this->assertContains($pet->status, StatusEnum::cases());
                $this->assertTrue(in_array($pet->status, StatusEnum::cases()));
                break;
            case 'withCategory':
                $this->assertInstanceOf(Category::class, $pet->category);
                break;
            case 'withTags':
                $this->assertIsIterable($pet->tag);

                foreach($pet->tag as $tag) {
                    $this->assertInstanceOf(Tag::class, $tag);
                }
                break;
        }
        
    }

    public static function petDataProvider(): array
    {
        return [
            'simple' => [
                'simple',
                Pet::factory()->make()
            ],
            'withId' => [
                'withId',
                Pet::factory()
                    ->withId()
                    ->make()
            ],
            'withStatus' => [
                'withStatus',
                Pet::factory()
                    ->withStatus()
                    ->make()
            ],
            'withCategory' => [
                'withCategory',
                Pet::factory()
                    ->withCategory()
                    ->make()
            ],
            'withTags' => [
                'withTags',
                Pet::factory()
                    ->withTags()
                    ->make()
            ],
        ];
    }
}
