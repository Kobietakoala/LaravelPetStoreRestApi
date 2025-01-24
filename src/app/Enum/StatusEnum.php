<?php
declare(strict_types=1);

namespace App\Enum;

/**
 * @package App\Enum
 */
enum StatusEnum: string
{
	case AVAILABLE= 'available';
	case PENDING = 'pending';
	case SOLD = 'sold';

	public function value(): string
	{
		return match($this){
			self::AVAILABLE => 'available',
			self::PENDING => 'pending',
			self::SOLD => 'available'
		};
	}
}