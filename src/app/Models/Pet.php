<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @package App\Model
 * 
 * @property ?int $id
 * @property string $name
 * @property json&string $photoUrls
 * @property ?Category $category
 * @property Array[Tag]|null $tag
 * @property StatusEnum&string|null $status
 */
class Pet extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'name', 'photoUrls', 'category', 'status', 'tag'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    protected function casts(): array
    {
        return [
            'photoUrls' => 'array',
        ];
    }
}
