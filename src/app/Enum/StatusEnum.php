<?php
declare(strict_types=1);

namespace App\Enum;

/**
 * @package App\Enum
 */
enum StatusEnum: string
{
	case AVAILABLE= 'Available';
	case PENDING = 'Pending';
	case SOLD = 'Sold';

	public function value(): string
	{
		return match($this){
			self::AVAILABLE => 'Available',
			self::PENDING => 'Pending',
			self::SOLD => 'Sold'
		};
	}
}