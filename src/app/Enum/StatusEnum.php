<?php
declare(strict_types=1);

namespace App\Enum;

/**
 * @package App\Enum
 */
enum StatusEnum: string
{
	case AVAILABLE = 'available';
	case PENDING = 'pending';
	case SOLD = 'sold';
}