<?php
declare(strict_types=1);

namespace App\Enum;

/**
 * @todo Przenieść enum jako tabele do bazy
 * 
 * @package App\Enum
 */
enum ExampleCategoriesDataEnum: string
{
	case DOG= 'Doggo';
	case CAT = 'City Cat';
	case HAMSTER = 'Hamster Boss';

    case HAUSEFLY = 'Grredy Housefly';
}