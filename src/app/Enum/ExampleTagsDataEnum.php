<?php
declare(strict_types=1);

namespace App\Enum;

/**
 * @todo Przenieść enum jako tabele do bazy
 * 
 * @package App\Enum
 */
enum ExampleTagsDataEnum: string
{
	case CUTE= 'Super Cute';
	case EVIL = 'Clear Evil';
	case BOSS = 'Week Boss';

    case MONSTER = 'Lucky Monster';
}