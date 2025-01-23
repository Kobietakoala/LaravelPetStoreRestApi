<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Model
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
}
